<div class="instructions">
  <h1>Instructions</h1>
  <table>
    <tr>
      <th>ID</th>
      <th>Header</th>
      <th>Theme</th>
      <th>Content</th>
      <th>Role</th>
      <th>Author</th>
    </tr>
    <?php foreach($instructions as $instruction) : ?>
    <tr>
      <td><?php echo $instruction['id']; ?></td>
      <td><?php echo $instruction['header']; ?></td>
      <td><?php echo $instruction['theme']; ?></td>
      <td><?php echo $instruction['content']; ?></td>
      <td><?php echo $instruction['role']; ?></td>
      <td><?php echo $instruction['author']; ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
</div>