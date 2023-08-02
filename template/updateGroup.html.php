<h1 class="titles-center mt-5">Update Group</h1>
<div class="row mx-5">
    <div class="d-flex justify-content-center">
        <form method="post">
            <input class="btn btn-primary" type="submit" name="back-button" value="Back to Group">
        </form>
    </div>
</div>
<form method="POST" class="registerform">
    <div class="row">
        <div class="col-md-6">
            <div class="card my-2 rounded border-0 shadow">
                <div class="card-body rounded border-0">
                    <table class="signup-table ">
                        <tr>
                            <td><input class="rounded-2 my-2 border-glow" type="text" name="group_name" size="30"
                                    placeholder="Group Name"></td>
                        </tr>
                        <tr>
                            <td>
                                <select class="rounded-2 my-2 border-glow" id="group_region" name="group_region"
                                    title="Group Region selection">
                                    <option value="" selected disabled hidden>Group Region</option>
                                    <option>South East</option>
                                    <option>London</option>
                                    <option>North West</option>
                                    <option>East of England</option>
                                    <option>West Midlands</option>
                                    <option>South West</option>
                                    <option>Yorkshire and the Humber</option>
                                    <option>East Midlands</option>
                                    <option>North East</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><textarea class="rounded-2 my-2 border-glow form-control no-resize" maxlength="230"
                                    type="text" name="group_details" size="30" rows="4"
                                    placeholder="Group Details"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td><select class="rounded-2 my-2 border-glow" id="group_icon" name="group_icon"
                                    title="Group_icon_selection">
                                    <option value="" selected disabled hidden>Group Icon</option>
                                    <option value="uploads/coffee-colour.png">Coffee - Colour </option>
                                    <option value="uploads/coffee-bw.png">Coffee - Black on White</option>
                                    <option value="uploads/coffee-wb.png">Coffee - White on Black</option>
                                    <option value="uploads/cycling-yellow.png">Coffee - Yellow</option>
                                    <option value="uploads/cycling-bw.png">Cycling - Black on White</option>
                                    <option value="uploads/cycling-wb.png">Cycling - White on Black</option>
                                </select></td>
                        </tr>

                    </table>



                    <div class="signup-button">
                        <input class="btn btn-primary" type="submit" name="reg-group-button" value="Update Group">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card my-2 rounded border-0 shadow">
                <div class="card-body rounded border-0">
                    <table class="signup-table ">
                        <?php foreach ($currentgroupinfo as $groupinfo): ?>
                            <tr>
                                <td>
                                    <p class="text-center">Current group details</p>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <p class="text-center">
                                        <?php echo "<b>Group Name:</b> " .$groupinfo['group_name'] ?>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="text-center">
                                        <?php echo "<b>Group Region:</b> " .$groupinfo['group_region'] ?>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="text-center">
                                        <?php echo "<b>Group Details:</b> " .$groupinfo['group_details'] ?>
                                    </p>
                                </td>
                            </tr>

                            <tr>
                                <td><p class="text-center">
                                    <?php echo "<b>Group Icon:</b> " .$groupinfo['group_icon']?></p>
                                    <image src=<?php echo $groupinfo['group_icon'] ?>
                                        class="welcomeImage rounded border-0 shadow">
                                </td>
                            </tr>

                        </table>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
</form>
</div>
<div class="col-sm-4 mx-auto">
    <div class="card my-2 rounded border-0 shadow">
        <div class="card-body rounded border-0">
            <h5 class="text-center">Group Icons</h5>
            <div class="d-flex justify-content-center">
                <div class="bd-example card-text">
                    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active">
                            </li>
                            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></li>
                            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></li>
                            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3"></li>
                            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4"></li>
                            <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="5"></li>

                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="2000">
                                <img src="uploads/coffee-colour.png" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5 class="whitetext">Coffee - Colour</h5>

                                </div>
                            </div>
                            <div class="carousel-item" data-bs-interval="2000">
                                <img src="uploads/coffee-bw.png" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5 class="blacktext">Coffee - Black on White</h5>
                                </div>
                            </div>
                            <div class="carousel-item" data-bs-interval="2000">
                                <img src="uploads/coffee-wb.png" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5 class="whitetext">Coffee - White on Black</h5>
                                </div>
                            </div>
                            <div class="carousel-item" data-bs-interval="2000">
                                <img src="uploads/cycling-yellow.png" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5 class="blacktext">Cycling - Yellow</h5>
                                </div>
                            </div>
                            <div class="carousel-item" data-bs-interval="2000">
                                <img src="uploads/cycling-bw.png" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5 class="blacktext">Cycling - Black on White</h5>
                                </div>
                            </div>
                            <div class="carousel-item" data-bs-interval="2000">
                                <img src="uploads/cycling-wb.png" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5 class="whitetext">Cycling - White on Black</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






</div>
</div>
<div class="registerform">
    <?php
    if (isset($errormessage[7])) {
        foreach ($errormessage[7] as $groupnameexistserror) {
            echo '<div class="rounded border-0 shadow alert alert-danger">';
            echo '<div class="rounded border-0">';
            echo "<p class='loginform'>" . $groupnameexistserror . "</p>";
            echo '</div>';
            echo '</div>';
        }
    }
    ;
    ?>
</div>