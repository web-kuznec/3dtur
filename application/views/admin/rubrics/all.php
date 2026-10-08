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
                            <th>Название</th>
                            <th>Сортировка</th>
                            <th><a title="Добавить" href="/admin/rubrics/add"><em class="fa fa-plus-circle"></em></a></th>
                        </tr>
                    </thead>
                    <tbody><?php
                    foreach($rubrics as $k => $v)
                    {?>
                        <tr>
                            <td><?= $v->id; ?></td>
                            <td><?= $v->name; ?></td>
                            <td><?= $v->sort; ?></td>
                            <td>
                                <a title="Редактировать" href="/admin/rubrics/edit/<?= $v->id; ?>"><em class="fa fa-cogs"></em></a> 
                                &nbsp;&nbsp;<a title="Удалить" href="/admin/rubrics/dell/<?= $v->id; ?>"><em class="fa fa-times-circle"></em></a>
                            </td>
                        </tr><?php
                    } ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</article>