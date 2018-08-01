<h1 class="jumbotron-heading">Fotos</h1>

<div class="row">
    <?php foreach ($posts as $post): ?>
    <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
            <?php if($post['Post']['image']): ?>
            <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="<?= $img_path . $post['Post']['image'] ?>" data-holder-rendered="true">
            <?php else: ?>
            <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_164f1ca9b53%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_164f1ca9b53%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.7265625%22%20y%3D%22120.3%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
            <?php endif ?>
            <div class="card-body">
            <p class="card-text">
                ID: <?= $post['Post']['id']; ?> <br>
                Title: <?= $post['Post']['title']; ?>
            </p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <?= $this->Html->link('View',
                            ['controller' => 'posts', 'action' => 'view', $post['Post']['id']],
                            ['class'=> 'btn btn-sm btn-outline-secondary']); ?>

                    <?= $this->Html->link('Edit',
                            ['controller' => 'posts', 'action' => 'edit', $post['Post']['id']],
                            ['class'=> 'btn btn-sm btn-outline-secondary']); ?>
                </div>
                <small class="text-muted"><?= $post['Post']['created']; ?></small>
            </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php unset($post); ?>
</div>
