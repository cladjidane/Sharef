<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($category['id'], 'category_edit', $category) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_referent">
  <span class="<?php echo $category->getNode()->isLeaf() ? 'file' : 'folder' ?>">
    <?php echo $category['referent'] ?>
  </span>
</td>

