<?php if ($_GET['page'] == 1): ?>
  <div class="card mx-5 mt-5 shadow">
    <div class="card-header container-fluid py-2 pt-1">
      <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item">
          <a class="nav-link active" href="#">My Details</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-linkcolour" href="profile.php?page=2">My Groups</a>
        </li>
        <li class="nav-item nav-linkcolour">
          <a class="nav-link nav-linkcolour" href="profile.php?page=3">My Events</a>
        </li>
      </ul>
    </div>

    <div class="card-body rounded-bottom">
      <table class="table py-0 px-0 ps-1 table-borderless">
        <tr>
          <th>First name</th>
          <th>Last name</th>
          <th>Password</th>
          <th>User Name</th>
          <th>Account type</th>
        </tr>

        <tr>
          <td>
            <?php echo ($alluserdata['first_name']) ?>
          </td>
          <td>
            <?php echo ($alluserdata['last_name']) ?>
          </td>
          <td>
            <?php echo "*********" ?>
          </td>
          <td>
            <?php echo ($alluserdata['user_name']) ?>
          </td>

          <td>
            <?php if (($alluserdata['user_type']) == "ADMIN") {
              echo "Admin";
            } else {
              echo "Normal";
            } ?>
          </td>
        </tr>

        <form method="POST" action="">
          <tr>
            <td><input class="rounded-2 my-2 border-glow" type="text" name="first_name" size="20"
                placeholder="First Name">
            </td>
            <td><input class="rounded-2 my-2 border-glow" type="text" name="last_name" size="20" placeholder="Last Name">
            </td>
            <td><input class="rounded-2 my-2 border-glow" type="text" name="user_password" size="20"
                placeholder="Password">
            </td>
            <td><input class="rounded-2 my-2 border-glow" type="text" name="user_name" size="20" placeholder="User Name">
            </td>

           
          </tr>
          <tr>
            <td>
              <?php
              if (isset($errormessage[0])) {
                foreach ($errormessage[0] as $firstnameerror) {
                  echo "<p class='small text-danger errormessages'>" . $firstnameerror . "</p>";
                }
              }
              ; ?>
            </td>
            <td>
              <?php
              if (isset($errormessage[1])) {
                foreach ($errormessage[1] as $lastnameerror) {
                  echo "<p class='small text-danger errormessages'>" . $lastnameerror . "</p>";
                }
              }
              ; ?>
            </td>
            <td>
              <?php
              if (isset($errormessage[2])) {
                foreach ($errormessage[2] as $usernameerror) {
                  echo '<div class="card border-danger mb-3" style="max-width: 18rem;">
                <div class="card-header">Header</div>
                <div class="card-body text-danger">
                <h5 class="card-title">Danger card title</h5>
                <p class="card-text"><p class="small text-danger errormessages">' . $usernameerror . '</p>
                </div>';
                }
              }
              ; ?>
            </td>
            <td>
              <?php
              if (isset($errormessage[4])) {
                foreach ($errormessage[4] as $passworderror) {
                  echo "<p class='small text-danger errormessages'>" . $passworderror . "</p>";
                }
              }
              ; ?>
            </td>
          </tr>
          <tr>
            <td><input type="submit" name="update-button" value="Update" class="update-button btn btn-primary"></td>
            <td><button type="button" class="delete-button btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#Modal">
                Delete Account
              </button></td>
          </tr>

          <div class="modal modalfade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="ModalLabel">Confirm Delete</h5>
                </div>
                <div class="modal-body">
                  This account will be removed from all groups/events and your comments will also be deleted.<br><br>Are
                  you sure you wish to Proceed?
                </div>
                <form method="post">
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button value="Delete Account" type="submit" name="delete-account-button" class="btn btn-danger"
                      data-bs-dismiss="modal">Delete Account</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </form>
      </table>
    </div>
  </div>
<?php endif; ?>

<?php if ($_GET['page'] == 2): ?>
  <div class="card mx-5 mt-5 shadow rounded-bottom">
    <div class="card-header container-fluid py-1">
      <div class="row">

        <div class="col-md-4">
          <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
              <a class="nav-link nav-linkcolour" href="profile.php?page=1">My Details</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">My Groups</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-linkcolour" href="profile.php?page=3">My Events</a>
            </li>
            <form method="post">
        </div>

        <div class="col-md-8">
          <div class="profilefilterform">
            <label class="px-2" for="group_name">Group Name
              <input type="radio" name="filter" id="group_name" value="group_name" <?php if ($_POST['filter'] == "group_name") {
                echo "checked";
              } ?> /></label>

            <label class="px-2" for="group_owned">Owned Groups
              <input type="radio" name="filter" id="group_owned" value="is_group_owner" <?php if ($_POST['filter'] == "is_group_owner") {
                echo "checked";
              } ?> /></label>

              <label class="px-2" for="group_region">Group Region
              <input type="radio" name="filter" id="group_region" value="group_region" <?php if ($_POST['filter'] == "group_region") {
                echo "checked";
              } ?> /></label>

            <button type="submit" class="btn btn-primary" name="apply_filter">Apply filter</button>
            </form>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="card-body py-0 px-0 ps-1">
      <table class="table table-hover my-0 table-borderless">
        <tr>
          <th>Group Name</th>
          <th>Group Region</th>
          <th>Group Owner?</th>
          <th>Group Link</th>
          <th>Unregister</th>
        </tr>
        <?php $num_grp = 0?>
        <?php foreach ($groups as $group): ?>

          <tr>
            <td>
              <?php echo htmlspecialchars($group['group_name'], ENT_QUOTES, 'utf-8') ?>
            </td>
            <td>
              <?php echo htmlspecialchars($group['group_region'], ENT_QUOTES, 'utf-8') ?>
            </td>

            <td>
              <?php echo htmlspecialchars($group['is_group_owner'], ENT_QUOTES, 'utf-8') ?>
            </td>
            <td class="px-0">
              <?php echo '<a href=' . "viewGroup.php?group_id=" . $group["group_id"] . '>Group page</a>' ?>
            </td>
            <?php if ($group['is_group_owner'] == "No"): ?>
              <td>
                <?php echo '<a href=' . "unregisterGroup.php?group_id=" . $group["group_id"] . '>Unregister</a>' ?>
              </td>
            <?php else: ?>
              <td>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=<?php echo "#modb" . $num_grp?>>
                  Delete Group
                </button>
                <div class="modal modalfade" id=<?php echo "modb" . $num_grp?> tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">Confirm Delete</h5>
                      </div>
                      <div class="modal-body">
                        Deleting this group will remove all users. Are you sure you wish to Proceed?
                        <?php $num_grp++;?>
                      </div>
                      <form method="post">
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                          <button value=<?php echo $group["group_id"] ?> type="submit" name="delete-group-button"
                            class="btn btn-danger" data-bs-dismiss="modal">Delete Group</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
          <?php endif; ?>
        <?php endforeach; ?>
      </table>

    </div>
  <?php endif; ?>

  <?php if ($_GET['page'] == 3): ?>
    <div class="card mx-5 mt-5 shadow rounded-bottom">
      <div class="card-header container-fluid py-1">
        <div class="row">
          <div class="col-md-4">
            <ul class="nav nav-tabs card-header-tabs">
              <li class="nav-item">
                <a class="nav-link nav-linkcolour" href="profile.php?page=1">My Details</a>
              </li>
              <li class="nav-item">
                <a class="nav-link nav-linkcolour" href="profile.php?page=2">My Groups</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="#">My Events</a>
              </li>
              <form method="post">
          </div>
          <div class="col-md-8">
            <div class="profilefilterform">
              <label for="event_name">Event Name</label>
              <input class="me-3" type="radio" name="eventfilter" id="event_name" value="event_name" <?php if ($_POST['eventfilter'] == "event_name") {
                echo "checked";
              } ?> />
              <label for="event_location">Location</label>
              <input class="me-3" type="radio" name="eventfilter" id="event_location" value="event_location" <?php if ($_POST['eventfilter'] == "event_location") {
                echo "checked";
              } ?> />
              <label for="event_datetime">Date</label>
              <input class="me-3" type="radio" name="eventfilter" id="event_datetime" value="event_datetime" <?php if ($_POST['eventfilter'] == "event_datetime") {
                echo "checked";
              } ?> />
              <label for="is_event_owner">Owned Events</label>
              <input class="me-3" type="radio" name="eventfilter" id="is_event_owner" value="is_event_owner" <?php if ($_POST['eventfilter'] == "is_event_owner") {
                echo "checked";
              } ?> />
              <button type="submit" class="btn btn-primary" name="apply_event_filter">Apply filter</button>
              </form>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="card-body mx-0 px-0 my-0 py-0">

        <?php if (!empty($events)): ?>

          <table class="table table-hover my-0 table-borderless">
            <tr>

              <th>Event Name</th>
              <th>Location</th>
              <th>Date/Time</th>
              <th>Event Owner?</th>
              <th>Event Link</th>
              <th>Unregister</th>
             
            </tr>
            <?php $num = 0?>
            <?php foreach ($events as $event): ?>
              <tr>

                <td>
                  <?php echo htmlspecialchars($event['event_name'], ENT_QUOTES, 'utf-8') ?>
                </td>

                <td>
                  <?php echo htmlspecialchars($event['event_location'], ENT_QUOTES, 'utf-8') ?>
                </td>

                <td>
                  <?php $date = new Datetime($event['event_datetime']);
                  $formatteddate = $date->format('d-m-Y H:i:s');
                  ?>
                  <?php echo htmlspecialchars($formatteddate, ENT_QUOTES, 'utf-8') ?>
                </td>

                <td>
                  <?php echo htmlspecialchars($event['is_event_owner'], ENT_QUOTES, 'utf-8') ?>
                </td>

                <td>
                  <?php echo '<a href=' . "viewEvent.php?event_id=" . $event['event_id'] . '>Event page</a>' ?>
                </td>


                <form method="post">
                  <?php if ($event['is_event_owner'] == "No"): ?>
                    <td>
                      <?php echo "<a class='btn btn-primary'" . 'href=' . "unregisterEvent.php?event_id=" . $event["event_id"] . '>Unregister</a>' ?>
                    </td>
                  <?php else: ?>
                    <td>
                      
                   
                      <button name="delete-event" type="button" class="btn btn-danger" value=<?php echo $event["event_id"]?> data-bs-toggle="modal"
                data-bs-target=<?php echo "#mod" . $num?>>
            
                
                
                        Delete Event
                      </button>
                      <div class="modal modalfade" id=<?php echo "mod" . $num?> tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="ModalLabel">Confirm Delete</h5>

                            </div>
                            <div class="modal-body">
                              Deleting this event will remove all users. Are you sure you wish to Proceed?
                            <?php $num++;?>
                            </div>

                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                              <button name="delete-event-button" type="submit" class="btn btn-danger" value=<?php echo $event["event_id"] ?>  
                                 data-bs-dismiss="modal">Delete Event</button>
                            </div>

                          </div>
                        </div>
                      </div>


                    </td>
                  <?php endif; ?>

                  
                  
                  
                <?php endforeach; ?>
            </tr>
            </form>

          </table>

        <?php endif; ?>

      </div>
    <?php endif; ?>


    <form method="POST" action="">
      <?php
      if (isset($deleteconfirmation)) {
        echo $deleteconfirmation;
      }
      ;
      ?>
    </form>

   