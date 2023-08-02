<h1 class="text-center mt-5 display-2"> Events</h1>

<div class="container">
    <form method="post">
        <div class="row">
            <div class="col-md-7 d-flex align-items-end">
                <input class="btn btn-primary mx-1" type="submit" name="add-event-button" value="Create a New Event">
                <?php if (!empty($_GET['pattern'])): ?>
                    <button class="btn btn-primary mx-1" type="submit" name="reset_filter">Reset filter
                    </button>
                    <?php echo $totalevents . " search results matching " . '"' . $_GET['pattern'] . '"' . " for " . $display_filter ?>
                <?php endif; ?>

            </div>
            <div class="col-md-5">
                <div class="float-left">
                    <label for="event_name">Event Name</label>
                    <input class="me-3" type="radio" name="eventfilter" id="event_name" value="event_name" <?php if ($_GET['filter'] == "event_name") {
                        echo "checked";
                    } ?> />
                    <label for="event_location">Location</label>
                    <input class="me-3" type="radio" name="eventfilter" id="event_location" value="event_location" <?php if ($_GET['filter'] == "event_location") {
                        echo "checked";
                    } ?> />
                    <label for="event_datetime">Date</label>
                    <input class="me-3" type="radio" name="eventfilter" id="event_datetime" value="event_datetime" <?php if ($_GET['filter'] == "event_datetime") {
                        echo "checked";
                    } ?> />
                    <label for="is_event_owner">Owned Events</label>
                    <input class="me-5" type="radio" name="eventfilter" id="is_event_owner" value="is_event_owner" <?php if ($_GET['filter'] == "is_event_owner") {
                        echo "checked";
                    } ?> />
                </div>
                <div class="input-group">
                    <input class="form-control" type="search" name="search_events" id="search-input">
                    <button class="btn btn-primary" type="submit" name="search_events_btn">Search
                    </button>
                </div>


            </div>
        </div>
        <div class="row">
            <div class="col-md-7">

        </div>
            <div class="col-md-5">
                <div class="card my-2 rounded border-0 d-flex justify-content-end mt-4">
                    <div class="card-body rounded border-0 px-0 py-0">
                        <div class="text-center">
                            <p class="card-text badge text-bg-light my-2">
                                <?php echo "Location" ?>
                            </p>
                            <p class="card-text badge text-bg-info my-2">
                                <?php echo "Date" ?>
                            </p>
                            <p class="card-text badge text-bg-primary my-2">
                                <?php echo "Type" ?>
                            </p>
                            <p class="card-text badge text-bg-success my-2">
                                <?php echo "< 30% full" ?>
                            </p>
                            <p class="card-text badge text-bg-warning my-2">
                                <?php echo "< 60% full" ?>
                            </p>
                            <p class="card-text badge text-bg-danger my-2">
                                <?php echo "Few places left" ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>



    <?php foreach ($events as $event): ?>
        <?php $hostcheck = getEventByEventId_JoinGroup($pdo, $event['event_id']); ?>
        <?php $registeredcheckevent = checkIfUserRegisteredEvent($pdo, $event['event_id'], $_SESSION['id']) ?>
        <?php $eventownercheck = checkIfEventOwner($pdo, $_SESSION['id'], "YES", $event['event_id']); ?>
        <?php $registered = countRegistered($pdo, $event['event_id']); ?>
        <?php if (($registered / $event['event_capacity']) <= 0.3): ?>
            <?php $style = "<p class='badge text-bg-success float-right mx-1 my-0'>" ?>

        <?php elseif (($registered / $event['event_capacity']) <= 0.6 && ($registered / $event['event_capacity']) > 0.3): ?>
            <?php $style = "<p class='badge text-bg-warning mx-1 my-0'>" ?>

        <?php elseif (($registered / $event['event_capacity']) >= 0.6): ?>
            <?php $style = "<p class='badge text-bg-danger mx-1 my-0'>" ?>
        <?php endif; ?>


        <?php $sponsorcheck = eventSponsorDetails($pdo, $event['event_id']); ?>
        <?php if(!empty($sponsorcheck)):?>
            <?php $sponsored = "card-body rounded border-0 px-0 py-0 whitetextonly "?>
            <?php $sponsored_text = " - <b><i>Sponsored Event!</b></i>"?>
               <?php else:?>
                <?php $sponsored = "card-body rounded border-0 px-0 py-0"?>
                <?php $sponsored_text =""?>
                    <?php endif;?>

                    
        <div class="card my-2 rounded border-0 mb-3">
            <div class="<?php echo $sponsored?>">
                <div class="card-header h2 d-flex justify-content-between border-0 d-flex align-items-center">
                    <div class="justify-content-start">

                   <?php echo '<a class="whitetextonly text-decoration-none" href=viewEvent.php?event_id=' . $event["event_id"] . '>' . $event['event_name'].$sponsored_text; ?></a>
                        </div>
                        <div class="justify-content-end h5 my-0">
                                <?php if (!empty($hostcheck)):?>
                                <p class="card-text badge text-bg-dark mx-1 my-0"><?php echo "Hosted" ?></p>
                                <?php endif; ?>
                                
                                <?php if (!empty($eventownercheck)):
                                    echo '<p class="badge text-bg-success mx-1 my-0">
                                    You own this event
                                    </p>';
                                    ?>
                                <?php else: ?>
                                    <?php if (!empty($registeredcheckevent)) {
                                        echo '<p class="badge text-bg-success mx-1 my-0">
                                    Registered
                                </p>';
                                    } ?>
                                <?php endif; ?>
                                

                                <?php echo $style . $registered . "/" . $event['event_capacity'] . '</p>'; ?>
                        </div>
                        
                </div>
                <div class="row py-3 px-3">
                    <div class="col-md-6 h5">
                    
                            
                        
                        <p class="card-text badge text-bg-light my-1">
                            <?php echo $event['event_location']; ?>
                        </p>
                        <p class="card-text badge text-bg-info my-1">
                            <?php $date = new Datetime($event['event_datetime']);
                            $formatteddate = $date->format('d-m-Y H:i:s');
                            ?>
                            <?php echo $formatteddate; ?>
                        </p>
                        <p class="badge text-bg-primary my-1">
                            <?php echo $event['event_type']; ?>
                        </p>
                       
                    </div>


                    <div class="col-md-6 h4 d-flex justify-content-end">
                        <div class="d-flex flex-column mb-3">
                            
                            
                                <?php foreach ($hostcheck as $img): ?>
                            <div>
                                <div class="d-flex justify-content-end">
                                <img src=<?php echo $img['group_icon']; ?> class="event-thumbnail rounded shadow">
                                </div>
                            </div>
                        
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach; ?>

    <ul class="pagination paginationoverride">
        <?php if ($pagetotal > 0): ?>
            <?php for ($i = 1; $i <= ceil($totalevents / $pagetotal); $i++) { ?>
                <li class="page-item <?php if ($i == $currentpage)
                    echo 'active'; ?>">
                    <a class="page-link" href="?page=<?php echo $i . '&filter=' . $_GET['filter'] . '&pattern=' ?><?php if (!empty($_GET['pattern'])) {
                                 echo $_GET['pattern'];
                             } else {
                                 echo '';
                             } ?>"><?php echo $i; ?></a>
                </li>
            <?php } ?>
        <?php endif; ?>
    </ul>


</div>