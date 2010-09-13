<h1>Categorys List</h1>
<div class="sf_admin_list">
    <table cellspacing="0" id="main_list" class="treeTable">
        <tbody>
            <?php foreach ($categorys as $i => $category): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
            <tr id="node-<?php echo $category['id'] ?>" class="sf_admin_row <?php echo $odd ?><?php
            // insert hierarchical info
            $node = $category->getNode();
            if ($node->isValidNode() && $node->hasParent()) {
            echo " child-of-node-" . $node->getParent()->getId();
            }
            ?>">
                <td class="sf_admin_text sf_admin_list_td_id">
                    <?php echo link_to($category['id'], 'category_edit', $category) ?>
                </td>
                <td class="sf_admin_text sf_admin_list_td_name">
                    <span class="<?php echo $category->getNode()->isLeaf() ? 'file' : 'folder' ?>">
                        <?php echo $category['name'] ?>
                    </span>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


<ul>
    <?php foreach ($categorys as $i => $category):
        $odd = fmod(++$i, 2) ? 'odd' : 'even';
        $node = $category->getNode();
        ?>

        <?php if ($node->isValidNode() && $node->hasParent()) : ?>

            <?php if (!$node->hasPrevSibling()) echo '<ul>'; ?>

            <li class="<?php echo " child-of-node-" . $node->getParent()->getId(); ?>">
            
                <span id="" class="<?php echo $category->getNode()->isLeaf() ? 'file' : 'folder' ?>">
 
                    <?php

                        echo $category['name'];

                        if ($node->hasChildren()) {
                            //echo '<!--<span style="background: orange">Il y a des enfant</span>-->';
                            //echo $category['name'];
                        } else {
                            //echo '<!--<span style="background: orange">Pas d\'enfant</span>-->';
                            //echo $category['name'];
                        }

                        if ($node->hasNextSibling()) {
                            //echo '<!--<span style="background: silver">le prochain frêre est ' . $node->getNextSibling() . '</span> -->';
                            //echo $category['name'];
                        } else {
                            //echo '</ul><!--<span style="background: silver">Pas de frêre après /UL</span>-->';
                            //echo '</ul>'; //.$category['name'];
                        }

                        if ($node->hasPrevSibling()) {
                            //echo '<!--<span style="background: HotPink">le frêre précédent est ' . $node->getPrevSibling() . '</span> -->';
                            //echo $category['name'];
                        } else {
                            //echo '<ul><!--<span style="background: HotPink">Pas de frêre avant UL</span>-->';
                            //echo '<ul>';
                        }
                    ?>
                </span>
            </li>

            <?php if (!$node->hasNextSibling() && !$node->hasChildren()) echo '</ul>'; ?>

            <?php else : ?>
            <li class="node-1">

                <span class="<?php echo $category->getNode()->isLeaf() ? 'file' : 'folder' ?>">

                    <?php
                        echo $category['name'];
                    ?>
                </span>
            <?php
                /*if (!$node->hasChildren() || !$node->hasNextSibling())*/ echo '</li>';
            ?>

        <?php endif; ?>
    <?php endforeach; ?>
</ul>

</div>
<a href="<?php echo url_for('category/new') ?>">New</a>
<script type="text/javascript">
/* <![CDATA[ 
function checkAll()
{
var boxes = document.getElementsByTagName('input'); for(index in boxes) { box = boxes[index]; if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox') box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked } return true;
}
$(document).ready(function()  {
$("#main_list").treeTable({
treeColumn: 2,
initialState: 'expanded'
});

// Configure draggable nodes
$("#main_list .file, #main_list .folder").draggable({
helper: "clone",
opacity: .75,
refreshPositions: true, // Performance?
revert: "invalid",
revertDuration: 300,
scroll: true
});

// Configure droppable rows
$("#main_list .file, #main_list .folder").each(function() {
$(this).parents("tr").droppable({
accept: ".file, .folder",
drop: function(e, ui) {
// Call jQuery treeTable plugin to move the branch
var parentTr = $($(ui.draggable).parents("tr"));
parentTr.appendBranchTo(this);
var parentId = parentTr.attr("id");
var thisId = this.id;
$("#select_" + parentId).val(thisId.substr(5));
},
hoverClass: "accept",
over: function(e, ui) {
// Make the droppable branch expand when a draggable node is moved over it.
if(this.id != ui.draggable.parents("tr")[0].id && !$(this).is(".expanded")) {
$(this).expand();
}
}
});
});

// Make visible that a row is clicked
$("table#main_list tbody tr").mousedown(function() {
$("tr.selected").removeClass("selected"); // Deselect currently selected rows
$(this).addClass("selected");
});

// Make sure row is selected when span is clicked
$("table#main_list tbody tr span").mousedown(function() {
$($(this).parents("tr")[0]).trigger("mousedown");
});
});
/* ]]> */
</script>
