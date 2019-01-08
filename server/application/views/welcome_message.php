<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
<head>
    <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.min.css")?>" >
    <script src="<?php echo base_url("assets/js/bootstrap.min.js")?>"></script>

    <script src="<?php echo base_url("assets/js/jquery-3.3.1.slim.min.js")?>"></script>
    <script src="<?php echo base_url("assets/js/popper.min.js")?>" ></script>

</head>
<body>
<div class="container">
    <br /><br />

    <div id="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Welcome to Long story!</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add User</h4>
                        <table class="table table-bordered">
                            <tr>
                                <th>Methods</th>
                                <td>POST</td>
                            </tr>
                            <tr>
                                <th>Function</th>
                                <td>addUser</td>
                            </tr>
                            <tr>
                                <th>Arguments</th>
                                <td>
                                    name: string<br />
                                    email: string<br />
                                    pass: string<br />
                                    birthdate: string (optional)<br />
                                    idProfile: int
                                </td>
                            </tr>
                            <tr>
                                <th>Return</th>
                                <td>Resturns a Json with all the fields on added user</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Get User</h4>
                        <table class="table table-bordered">
                            <tr>
                                <th>Methods</th>
                                <td>Get</td>
                            </tr>
                            <tr>
                                <th>Function</th>
                                <td>getUser</td>
                            </tr>
                            <tr>
                                <th>Arguments</th>
                                <td>
                                    id: int(optional)
                                </td>
                            </tr>
                            <tr>
                                <th>Return</th>
                                <td>Resturns a Json with all user</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        <br />
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit User</h4>
                        <table class="table table-bordered">
                            <tr>
                                <th>Methods</th>
                                <td>POST</td>
                            </tr>
                            <tr>
                                <th>Function</th>
                                <td>editUser</td>
                            </tr>
                            <tr>
                                <th>Arguments</th>
                                <td>
                                    name: string(optional)<br />
                                    email: string(optional)<br />
                                    pass: string(optional)<br />
                                    birthdate: string (optional)<br />
                                    idProfile: int(optional)
                                </td>
                            </tr>
                            <tr>
                                <th>Return</th>
                                <td>Resturns a Json with all the fields on the edited user</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Friend</h4>
                        <table class="table table-bordered">
                            <tr>
                                <th>Methods</th>
                                <td>POST</td>
                            </tr>
                            <tr>
                                <th>Function</th>
                                <td>addFriend</td>
                            </tr>
                            <tr>
                                <th>Arguments</th>
                                <td>
                                    idUser: int<br />
                                    idFriend: int
                                </td>
                            </tr>
                            <tr>
                                <th>Return</th>
                                <td>Resturns a message</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Get Friends</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Methods</th>
                                    <td>GET</td>
                                </tr>
                                <tr>
                                    <th>Function</th>
                                    <td>getFriend</td>
                                </tr>
                                <tr>
                                    <th>Arguments</th>
                                    <td>
                                        id: int
                                    </td>
                                </tr>
                                <tr>
                                    <th>Return</th>
                                    <td>Resturns a Json with all the friends of a specific user</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Get Profile</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Methods</th>
                                    <td>get</td>
                                </tr>
                                <tr>
                                    <th>Function</th>
                                    <td>getProfile</td>
                                </tr>
                                <tr>
                                    <th>Return</th>
                                    <td>Resturns all a list with all the possible profiles and their respective Id</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Change User Status</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Methods</th>
                                    <td>POST</td>
                                </tr>
                                <tr>
                                    <th>Function</th>
                                    <td>changeUserStatus</td>
                                </tr>
                                <tr>
                                    <th>Arguments</th>
                                    <td>
                                        idUser: int
                                    </td>
                                </tr>
                                <tr>
                                    <th>Return</th>
                                    <td>Resturns a message</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Get Profile</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Methods</th>
                                    <td>get</td>
                                </tr>
                                <tr>
                                    <th>Function</th>
                                    <td>getProfile</td>
                                </tr>
                                <tr>
                                    <th>Return</th>
                                    <td>Resturns all a list with all the possible profiles and their respective Id</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">get Books</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Methods</th>
                                    <td>GET</td>
                                </tr>
                                <tr>
                                    <th>Function</th>
                                    <td>getBooks</td>
                                </tr>
                                <tr>
                                    <th>Arguments</th>
                                    <td>
                                        idUser: int
                                    </td>
                                </tr>
                                <tr>
                                    <th>Return</th>
                                    <td>Returns a Json with all books that user can see</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add Book</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Methods</th>
                                    <td>POST</td>
                                </tr>
                                <tr>
                                    <th>Function</th>
                                    <td>addBook</td>
                                </tr>
                                <tr>
                                    <th>Arguments</th>
                                    <td>
                                        name: string<br />
                                        author: string<br />
                                        description: description<br />
                                        ISBN: BIGINT<br />
                                        image: string<br />
                                        idRegister: int<br />
                                        idGenders: idGenders
                                    </td>
                                </tr>
                                <tr>
                                    <th>Return</th>
                                    <td>Returns a json with all the information about the book</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">get Genders</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Methods</th>
                                    <td>GET</td>
                                </tr>
                                <tr>
                                    <th>Function</th>
                                    <td>getgenderss</td>
                                </tr>
                                <tr>
                                    <th>Arguments</th>
                                    <td>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Return</th>
                                    <td>Returns a Json with all the genders</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Get Book Info</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Methods</th>
                                    <td>GET</td>
                                </tr>
                                <tr>
                                    <th>Function</th>
                                    <td>getBookInfo</td>
                                </tr>
                                <tr>
                                    <th>Arguments</th>
                                    <td>
                                        idUser: int
                                    </td>
                                </tr>
                                <tr>
                                    <th>Return</th>
                                    <td>Returns a json with all the information about a specific book</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Set Owned</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Methods</th>
                                    <td>SET</td>
                                </tr>
                                <tr>
                                    <th>Function</th>
                                    <td>setOwned</td>
                                </tr>
                                <tr>
                                    <th>Arguments</th>
                                    <td>
                                        myIdUser: int<br>
                                        idBook: int
                                    </td>
                                </tr>
                                <tr>
                                    <th>Return</th>
                                    <td>Returns a message</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Get Owned</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Methods</th>
                                    <td>GET</td>
                                </tr>
                                <tr>
                                    <th>Function</th>
                                    <td>getOwned</td>
                                </tr>
                                <tr>
                                    <th>Arguments</th>
                                    <td>
                                        id: int
                                    </td>
                                </tr>
                                <tr>
                                    <th>Return</th>
                                    <td>Returns a json with all books that user ownes</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Set Read</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Methods</th>
                                    <td>SET</td>
                                </tr>
                                <tr>
                                    <th>Function</th>
                                    <td>setRead</td>
                                </tr>
                                <tr>
                                    <th>Arguments</th>
                                    <td>
                                        myIdUser: int<br>
                                        idBook: int
                                    </td>
                                </tr>
                                <tr>
                                    <th>Return</th>
                                    <td>Returns a message</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Get Read</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Methods</th>
                                    <td>GET</td>
                                </tr>
                                <tr>
                                    <th>Function</th>
                                    <td>getRead</td>
                                </tr>
                                <tr>
                                    <th>Arguments</th>
                                    <td>
                                        id: int
                                    </td>
                                </tr>
                                <tr>
                                    <th>Return</th>
                                    <td>Returns a json with all books that user has read</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Set Wishlist</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Methods</th>
                                    <td>SET</td>
                                </tr>
                                <tr>
                                    <th>Function</th>
                                    <td>setWishlist</td>
                                </tr>
                                <tr>
                                    <th>Arguments</th>
                                    <td>
                                        myIdUser: int<br>
                                        idBook: int
                                    </td>
                                </tr>
                                <tr>
                                    <th>Return</th>
                                    <td>Returns a message</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Get Wishlist</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Methods</th>
                                    <td>GET</td>
                                </tr>
                                <tr>
                                    <th>Function</th>
                                    <td>getWishlist</td>
                                </tr>
                                <tr>
                                    <th>Arguments</th>
                                    <td>
                                        id: int
                                    </td>
                                </tr>
                                <tr>
                                    <th>Return</th>
                                    <td>Returns a json with all books that users wishlist</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Rate Book</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Methods</th>
                                    <td>POST</td>
                                </tr>
                                <tr>
                                    <th>Function</th>
                                    <td>rateBook</td>
                                </tr>
                                <tr>
                                    <th>Arguments</th>
                                    <td>
                                        myIdUser: int<br>
                                        myBook: int<br>
                                        Rating: int
                                    </td>
                                </tr>
                                <tr>
                                    <th>Return</th>
                                    <td>Returns a message</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">SearchBook</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Methods</th>
                                    <td>POST</td>
                                </tr>
                                <tr>
                                    <th>Function</th>
                                    <td>searchBook</td>
                                </tr>
                                <tr>
                                    <th>Arguments</th>
                                    <td>
                                        name: string(Optional)<br>
                                        author: string(Optional)<br>
                                        ISBN: string(Optional)<br>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Return</th>
                                    <td>Returns a json with all books of that search</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Rate Book</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Methods</th>
                                    <td>POST</td>
                                </tr>
                                <tr>
                                    <th>Function</th>
                                    <td>rateBook</td>
                                </tr>
                                <tr>
                                    <th>Arguments</th>
                                    <td>
                                        IdBook: int<br />
                                        name: string<br />
                                        description: description<br />
                                        image: string<br />
                                        idStatusBook: idStatusBook<br>
                                        idAprover: int
                                    </td>
                                </tr>
                                <tr>
                                    <th>Return</th>
                                    <td>Returns a message</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

    </div>

</div>
</body>
</html>
