<div class="works-search-wrap<?= ! empty($search) ? ' is-open' : ''; ?>">
    <button type="button" class="works-search-toggle btn btn-default" aria-label="Поиск" aria-expanded="<?= ! empty($search) ? 'true' : 'false'; ?>">
        <i class="fas fa-search" aria-hidden="true"></i>
    </button>
    <form class="works-search-form" method="get" action="<?= $search_action; ?>">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Поиск" value="<?= ! empty($search) ? HTML::chars($search) : ''; ?>">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-default">Найти</button>
            </span>
        </div>
    </form>
</div>
