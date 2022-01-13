<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

.mg-lt{
  float: right;
  margin-right: 35px;
}
.mg-top{
  margin-top: 70px;
}
tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

 <a href="/user" class="btn btn-outline-primary mg-lt">Add User</a>
<h2 class="mg-top">Users Details</h2>
<table>
  <tr>
    <th>Surname</th>
    <th>Name</th>
    <th>Email Address</th>
    <th>Telephone number</th>
    <th>Gender</th>
    <th>Date of birth</th>
    <th>Comments</th>
  </tr>
    @foreach($data as $user)
  <tr>
    <td>{{$user->surname}}</td>
    <td>{{$user->first_name}}</td>
    <td>{{$user->gender}}</td>
    <td>{{$user->date}}</td>
    <td>{{$user->email}}</td>
    <td>{{$user->number}}</td>
    <td>{{$user->comments}}</td>
  </tr>
    @endforeach
</table>
</body>
</html>

