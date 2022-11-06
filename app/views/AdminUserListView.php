<div class="users">
  <h1>Users</h1>
  <table>
    <tr>
      <th>Code</th>
      <th>Role</th>
      <th>Firstname</th>
      <th>Secondname</th>
      <th>Email</th>
    </tr>
    <?php foreach($usersList as $user) : ?>
    <tr>
      <td><?php echo $user['code']; ?></td>
      <td><?php echo $user['role']; ?></td>
      <td><?php echo $user['firstname']; ?></td>
      <td><?php echo $user['secondname']; ?></td>
      <td><?php echo $user['email']; ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
</div>