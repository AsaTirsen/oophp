<?php

namespace Anax\View;

/**
 * Template file to render a view with plain content.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

if (!$resultset) {
    return;
}
?><table>
    <tr class="first">
        <th>Rad</th>
        <th>Id</th>
        <th>Bild</th>
        <th>Titel</th>
        <th>År</th>
    </tr>
    <?php $id = -1; foreach ($resultset as $row) :
        $id++; ?>
        <tr>
            <td><?= $id + 1 ?></td>
            <td><?= $row->id ?></td>
            <td><img class="thumb" src="<?= $row->image ?>" alt="filmtitle"></td>
            <td><?= $row->title ?></td>
            <td><?= $row->year ?></td>
        </tr>
    <?php endforeach; ?>
</table>
