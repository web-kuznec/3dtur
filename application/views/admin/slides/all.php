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
                            <th style="width:20px;"></th>
                        </tr>
                    </thead>
                    <tbody><?php
                    foreach($slides as $k => $v)
                    { ?>
                        <tr>
                            <td>Слайд <?= $v->id; ?></td>
                            <td>
                                <a title="Редактировать" href="/admin/slides/edit/<?= $v->id; ?>"><em class="fa fa-cogs"></em></a>
                            </td>
                        </tr><?php
                    } ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</article>