<h4>Add User</h4>

<form method="POST">
    <input type="text" name="name" class="form-control mb-2" placeholder="Name">

    <select name="role" class="form-control mb-2">
        <option>Doctor</option>
        <option>Patient</option>
        <option>Lab</option>
        <option>Admin</option>
    </select>

    <button class="btn btn-success">Save</button>
</form>

<?php
if($_POST){
    echo "User Saved (connect DB here)";
}
?>