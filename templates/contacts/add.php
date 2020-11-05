<?php

use App\View;

/**
 * @var View $this
 */
?><tr data-row>
    <th scope="row">
        <?php echo $this->count; ?>
    </th>
    <td><?php echo $this->contact->name; ?></td>
    <td><?php echo $this->contact->surname; ?></td>
    <td><?php echo $this->contact->phone_number; ?></td>
    <td class="pt-4">
        <a href="/list/<?php echo $this->contact->id; ?>">
            Подробнее
        </a>
    </td>
    <td>
        <form action="/list/<?php echo $this->contact->id; ?>/delete" method="post">
            <button type="submit" class="btn btn-link">Удалить</button>
        </form>
    </td>
</tr>