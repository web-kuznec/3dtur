<script src="<?= URL::base(); ?>public/js/bootstrap.min.js" type="text/javascript"></script>
<link href="<?= URL::base(); ?>public/css/font-awesome.min.css" rel="stylesheet">
<article class="content dashboard-page">
<div class="col-md-12">
    <div class="card">
        <div class="card-block">
            <section class="example">
                <table class="table">
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>Иконка</th>
                            <th>Заголовок</th>
                            <th>Текст</th>
                            <th><a title="Добавить" href="/admin/advances/add"><em class="fa fa-plus-circle"></em></a></th>
                        </tr>
                    </thead>
                    <tbody><?php
                    foreach($advances as $k => $v)
                    {?>
                        <tr>
                            <td><?= $v->id; ?></td>
                            <td><i class="fa <?= $v->awesome; ?>"></i></td>
                            <td><?= $v->h; ?></td>
                            <td><?= $v->p; ?></td>
                            <td>
                                <a title="Редактировать" href="/admin/advances/edit/<?= $v->id; ?>"><em class="fa fa-cogs"></em></a> 
                                &nbsp;&nbsp;<a title="Удалить" href="/admin/advances/dell/<?= $v->id; ?>"><em class="fa fa-times-circle"></em></a>
                            </td>
                        </tr><?php
                    } ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</article>