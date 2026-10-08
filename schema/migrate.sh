#!/usr/bin/env bash
set -euo pipefail

MYSQL_HOST="${MYSQL_HOST:-db}"
MYSQL_DATABASE="${MYSQL_DATABASE:-kohana_db}"
MYSQL_USER="${MYSQL_USER:-kohana_user}"
MYSQL_PASSWORD="${MYSQL_PASSWORD:-kohana_pass}"

export MYSQL_PWD="${MYSQL_PASSWORD}"

mysql_cli() {
  mysql -h "${MYSQL_HOST}" -u "${MYSQL_USER}" "${MYSQL_DATABASE}" "$@"
}

echo "Waiting for MySQL at ${MYSQL_HOST}..."
for i in $(seq 1 60); do
  if mysql_cli -e "SELECT 1" >/dev/null 2>&1; then
    break
  fi
  sleep 2
done
mysql_cli -e "SELECT 1" >/dev/null

mysql_cli -e "
CREATE TABLE IF NOT EXISTS schema_migrations (
  version VARCHAR(255) NOT NULL PRIMARY KEY,
  applied_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
"

migration_applied() {
  local version="$1"
  local count
  count="$(mysql_cli -N -e "SELECT COUNT(*) FROM schema_migrations WHERE version='${version}'")"
  [[ "${count}" != "0" ]]
}

mark_applied() {
  local version="$1"
  mysql_cli -e "INSERT INTO schema_migrations (version) VALUES ('${version}')"
}

column_exists() {
  local table="$1"
  local column="$2"
  mysql_cli -N -e "
    SELECT COUNT(*)
    FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA='${MYSQL_DATABASE}'
      AND TABLE_NAME='${table}'
      AND COLUMN_NAME='${column}'
  "
}

drop_column_if_exists() {
  local table="$1"
  local column="$2"
  if [[ "$(column_exists "${table}" "${column}")" == "1" ]]; then
    echo "  DROP COLUMN ${table}.${column}"
    mysql_cli -e "ALTER TABLE \`${table}\` DROP COLUMN \`${column}\`"
  fi
}

table_exists() {
  local table="$1"
  mysql_cli -N -e "
    SELECT COUNT(*)
    FROM information_schema.TABLES
    WHERE TABLE_SCHEMA='${MYSQL_DATABASE}'
      AND TABLE_NAME='${table}'
  "
}

legacy_schema_present() {
  [[ "$(table_exists reviews)" != "0" ]] \
    || [[ "$(table_exists news)" != "0" ]] \
    || [[ "$(column_exists articles groups_id)" != "0" ]] \
    || [[ "$(column_exists pages gruppa)" != "0" ]] \
    || [[ "$(column_exists rubricator parent)" != "0" ]]
}

apply_001_remove_unused() {
  echo "Applying 001_remove_unused (legacy schema detected)..."

  mysql_cli -e "SET FOREIGN_KEY_CHECKS=0"
  for t in admin_group banner_stat banner_photo banners banner_place banner_pages \
    basket news_photo news_history news orders_link_tovar orders reviews \
    tovars_link_rub tovars works_photo works_mini; do
    if [[ "$(table_exists "${t}")" != "0" ]]; then
      echo "  DROP TABLE ${t}"
      mysql_cli -e "DROP TABLE \`${t}\`"
    fi
  done

  drop_column_if_exists articles groups_id
  drop_column_if_exists articles guid
  drop_column_if_exists articles_img x
  drop_column_if_exists articles_img y
  drop_column_if_exists articles_img width
  drop_column_if_exists articles_img height
  drop_column_if_exists articles_img sort
  drop_column_if_exists users surname
  drop_column_if_exists users adress
  drop_column_if_exists users lord
  drop_column_if_exists users name
  drop_column_if_exists users phone
  drop_column_if_exists users url
  drop_column_if_exists works FK_user
  drop_column_if_exists works title
  drop_column_if_exists works keywords
  drop_column_if_exists works description
  drop_column_if_exists pages gruppa
  drop_column_if_exists rubricator parent
  drop_column_if_exists rubricator status
  drop_column_if_exists rubricator title
  drop_column_if_exists rubricator keywords
  drop_column_if_exists rubricator description
  drop_column_if_exists rubricator seo
  drop_column_if_exists rubricator class

  mysql_cli -e "SET FOREIGN_KEY_CHECKS=1"
}

rename_column_if_exists() {
  local table="$1"
  local old="$2"
  local new="$3"
  local definition="$4"
  if [[ "$(column_exists "${table}" "${old}")" == "1" ]]; then
    if [[ "$(column_exists "${table}" "${new}")" == "1" ]]; then
      echo "  Skip rename ${table}.${old} (${new} already exists)"
      return
    fi
    echo "  RENAME COLUMN ${table}.${old} -> ${new}"
    mysql_cli -e "ALTER TABLE \`${table}\` CHANGE COLUMN \`${old}\` \`${new}\` ${definition}"
  fi
}

rename_index_if_exists() {
  local table="$1"
  local old="$2"
  local new="$3"
  local column="$4"
  local count
  count="$(mysql_cli -N -e "
    SELECT COUNT(*)
    FROM information_schema.STATISTICS
    WHERE TABLE_SCHEMA='${MYSQL_DATABASE}'
      AND TABLE_NAME='${table}'
      AND INDEX_NAME='${old}'
  ")"
  if [[ "${count}" != "0" ]]; then
    echo "  RENAME INDEX ${table}.${old} -> ${new}"
    mysql_cli -e "ALTER TABLE \`${table}\` DROP INDEX \`${old}\`, ADD INDEX \`${new}\` (\`${column}\`)"
  fi
}

apply_002_rename_fk_columns() {
  echo "Applying 002_rename_fk_columns..."

  rename_column_if_exists pages FK_user user_id "int(11) DEFAULT NULL"
  rename_column_if_exists page_history user page_user_id "int(11) NOT NULL"
  rename_column_if_exists page_history FK_user changed_by_user_id "int(11) NOT NULL COMMENT 'пользователь, который внес изменения'"
  rename_column_if_exists page_history FK_page page_id "int(11) NOT NULL COMMENT 'id страницы которую изменили'"
  rename_column_if_exists articles_history FK_id article_id "int(11) NOT NULL"
  rename_column_if_exists articles_history FK_group group_id "int(11) NOT NULL"
  rename_column_if_exists users_history FK_id user_id "int(11) NOT NULL"
  rename_column_if_exists users_history FK_role role_id "int(11) NOT NULL"
  rename_column_if_exists users_history FK_user changed_by_user_id "int(11) NOT NULL"
  rename_index_if_exists articles_img FK_articles articles_id articles_id
}

MIGRATIONS_DIR="$(cd "$(dirname "$0")/migrations" && pwd)"

for file in $(ls -1 "${MIGRATIONS_DIR}"/*.sql 2>/dev/null | sort); do
  version="$(basename "${file}" .sql)"
  if migration_applied "${version}"; then
    echo "Skip ${version} (already applied)"
    continue
  fi

  case "${version}" in
    001_remove_unused)
      if legacy_schema_present; then
        apply_001_remove_unused
      else
        echo "Skip ${version} (database already matches trimmed schema)"
      fi
      ;;
    002_rename_fk_columns)
      apply_002_rename_fk_columns
      ;;
    *)
      echo "Applying ${version}..."
      mysql_cli < "${file}"
      ;;
  esac

  mark_applied "${version}"
  echo "Done ${version}"
done

echo "Migrations complete."
