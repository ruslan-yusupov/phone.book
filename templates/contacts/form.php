<?php

use App\View;

/**
 * @var View $this
 */

if (!empty($this->alerts)) { ?>
    <div class="row" data-alerts>
        <?php
        foreach ($this->alerts as $alert) { ?>
            <div class="alert alert-danger col mr-1" role="alert">
                <?php echo $alert; ?>
            </div>
        <?php } ?>
    </div>
<?php } ?>
<form action="/list/add" class="form-inline mt-5" data-form-submit method="post" enctype="multipart/form-data">
    <div class="form-group flex-row">
        <input type="file"
               class="form-control-file mb-4"
               name="picture"
               id="picture">

        <input type="text"
               class="form-control"
               id="name"
               name="name"
               value="<?php echo $_POST['name'] ?? ''; ?>"
               placeholder="Имя">

        <input type="text"
               class="form-control"
               id="surname"
               name="surname"
               value="<?php echo $_POST['surname'] ?? ''; ?>"
               placeholder="Фамилия">

        <input type="text"
               class="form-control"
               id="phone_number"
               name="phone_number"
               value="<?php echo $_POST['phone_number'] ?? ''; ?>"
               placeholder="Телефон">

        <input type="text"
               class="form-control"
               id="email"
               name="email"
               value="<?php echo $_POST['email'] ?? ''; ?>"
               placeholder="Email">

        <button type="submit" class="btn btn-primary">Добавить</button>
    </div>
</form>