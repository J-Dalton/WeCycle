<?php

##REUSABLE QUERY FUNCTION##

function query($pdo, $sql, $parameters = [])
{
	$query = $pdo->prepare($sql);
	$query->execute($parameters);
	return $query;
}



##User Functions##

function updateUser($pdo, $firstname, $lastname, $username, $password, $userid, $admin)
{

	$parameters = [':first_name' => $firstname, ':last_name' => $lastname, ':user_name' => $username, ':user_password' => $password, ':user_id' => $userid, ':user_type' => $admin];
	query($pdo, 'UPDATE User_tbl SET first_name = COALESCE(:first_name, first_name), 
	last_name = COALESCE(:last_name, last_name),
	user_name = COALESCE(:user_name, user_name), 
	user_password = COALESCE(:user_password, user_password),
	user_type = COALESCE(:user_type, user_type) 
	WHERE user_id = :user_id', $parameters);
}

## Update User functions separated ##
function updateUserF($pdo, $firstname, $userid)
{

	$parameters = [':first_name' => $firstname, ':user_id' => $userid];
	query($pdo, 'UPDATE User_tbl SET first_name = COALESCE(:first_name, first_name) WHERE user_id = :user_id', $parameters);
}

function updateUserL($pdo, $lastname, $userid)
{

	$parameters = [':last_name' => $lastname, ':user_id' => $userid];
	query($pdo, 'UPDATE User_tbl SET last_name = COALESCE(:last_name, last_name) WHERE user_id = :user_id', $parameters);
}

function updateUserU($pdo, $username, $userid)
{

	$parameters = [':user_name' => $username, ':user_id' => $userid];
	query($pdo, 'UPDATE User_tbl SET user_name = COALESCE(:user_name, user_name) WHERE user_id = :user_id', $parameters);
}

function updateUserP($pdo, $password, $userid)
{

	$parameters = [':user_password' => $password, ':user_id' => $userid];
	query($pdo, 'UPDATE User_tbl SET user_password = COALESCE(:user_password, user_password) WHERE user_id = :user_id', $parameters);
}

function updateUserE($pdo, $email, $userid)
{

	$parameters = [':User_email' => $email, ':User_id' => $userid];
	query($pdo, 'UPDATE User_tbl SET User_email = COALESCE(:User_email, User_email) WHERE user_id = :user_id', $parameters);
}

function updateUserA($pdo, $usertype, $userid)
{

	$parameters = [':user_type' => $usertype, ':user_id' => $userid];
	query($pdo, 'UPDATE User_tbl SET user_type = COALESCE(:user_type, user_type) WHERE user_id = :user_id', $parameters);
}




function getUserid($pdo, $username, $password)
{
	$parameters = [':user_name' => $username, ':user_password' => $password];
	$id = query($pdo, 'SELECT * FROM User_tbl WHERE BINARY user_name = :user_name  AND BINARY user_password = :user_password', $parameters);
	return $id->fetch();
}

function createUser($pdo, $firstname, $lastname, $username, $hashpassword, $admin)
{

	$query = 'INSERT INTO User_tbl (first_name, last_name, user_name, user_password, user_type)
	VALUES (:first_name, :last_name, :user_name, :user_password, :user_type)';
	$parameters = [':first_name' => $firstname, ':last_name' => $lastname, ':user_name' => $username, ':user_password' => $hashpassword, ':user_type' => $admin];
	query($pdo, $query, $parameters);
}

function deleteUser($pdo, $userid)
{
	$parameters = [':user_id' => $userid];
	query($pdo, 'DELETE FROM User_tbl WHERE user_id = :user_id', $parameters);
}


function allUserdata($pdo, $userid)
{
	$parameters = [':User_id' => $userid];
	$alluserdata = query($pdo, 'SELECT * From User_tbl WHERE User_id = :User_id', $parameters);
	return $alluserdata->fetch();
}



function userNameexists($pdo, $username)
{
	$parameters = [':user_name' => $username];
	$users = query($pdo, 'SELECT user_name FROM User_tbl WHERE user_name = :user_name', $parameters);
	return $users->fetchAll();
}


function getGroupsById($pdo, $userid)
{
	$parameters = [':user_id' => $userid];
	$groups = query($pdo, 'SELECT * From User_Group_tbl WHERE user_id = :user_id', $parameters);
	return $groups->fetchAll();
}

function getEventsById($pdo, $userid)
{
	$parameters = [':user_id' => $userid];
	$groups = query($pdo, 'SELECT * From User_Event_tbl WHERE user_id = :user_id', $parameters);
	return $groups->fetchAll();
}

function getEventByEventId($pdo, $eventid)
{
	$parameters = [':event_id' => $eventid];
	$event = query($pdo, 'SELECT * From Event_tbl WHERE event_id = :event_id', $parameters);
	return $event->fetchAll();
}



function getGroupByGroupId($pdo, $groupid)
{
	$parameters = [':group_id' => $groupid];
	$group = query($pdo, 'SELECT * From Group_tbl WHERE group_id = :group_id', $parameters);
	return $group->fetchAll();


}


function allGroups($pdo)
{
	$allgroups = query($pdo, 'SELECT * From Group_tbl');
	return $allgroups->fetchAll();
}



function addUserToGroup($pdo, $userid, $groupid, $owner)
{
	$query = 'INSERT INTO User_Group_tbl (user_id, group_id, is_group_owner)
	VALUES (:user_id, :group_id, :is_group_owner)';
	$parameters = [':user_id' => $userid, ':group_id' => $groupid, ':is_group_owner' => $owner];
	query($pdo, $query, $parameters);
}


function deleteUserFromGroup($pdo, $userid, $groupid)
{
	$parameters = [':user_id' => $userid, 'group_id' => $groupid];
	query($pdo, 'DELETE FROM User_Group_tbl WHERE user_id = :user_id AND group_id = :group_id', $parameters);
}


function getAllGroupMembers($pdo, $groupid)
{
	$parameters = [':group_id' => $groupid];
	$allgroups = query($pdo, 'SELECT * FROM User_Group_tbl WHERE group_id = :group_id', $parameters);
	return $allgroups->fetchAll();

}

function checkIfUserRegistered($pdo, $groupid, $userid)
{
	$parameters = [':user_id' => $userid, 'group_id' => $groupid];
	$allgroups = query($pdo, 'SELECT * FROM User_Group_tbl WHERE user_id = :user_id AND group_id = :group_id', $parameters);
	return $allgroups->fetchAll();
}

function checkIfGroupOwner($pdo, $userid, $groupowner, $groupid)
{
	$parameters = [':user_id' => $userid, 'is_group_owner' => $groupowner, 'group_id' => $groupid];
	$allgroups = query($pdo, 'SELECT * FROM User_Group_tbl WHERE user_id = :user_id AND group_id = :group_id AND is_group_owner = :is_group_owner', $parameters);
	return $allgroups->fetchAll();
}

function updateSetToGroupOwner($pdo, $groupowner, $groupid, $userid)
{

	$parameters = [':is_group_owner' => $groupowner, ':group_id' => $groupid, ':user_id' => $userid];
	query($pdo, 'UPDATE User_Group_tbl SET is_group_owner = :is_group_owner WHERE user_id = :user_id AND group_id = :group_id', $parameters);
}

function checkIfUserRegisteredEvent($pdo, $eventid, $userid)
{
	$parameters = [':user_id' => $userid, 'event_id' => $eventid];
	$allgroups = query($pdo, 'SELECT * FROM User_Event_tbl WHERE user_id = :user_id AND event_id = :event_id', $parameters);
	return $allgroups->fetchAll();
}

function checkIfEventOwner($pdo, $userid, $eventowner, $eventid)
{
	$parameters = [':user_id' => $userid, 'is_event_owner' => $eventowner, 'event_id' => $eventid];
	$allgroups = query($pdo, 'SELECT * FROM User_Event_tbl WHERE user_id = :user_id AND event_id = :event_id AND is_event_owner = :is_event_owner', $parameters);
	return $allgroups->fetchAll();
}

function getAllEventMembers($pdo, $eventid)
{
	$parameters = [':event_id' => $eventid];
	$allgroups = query($pdo, 'SELECT * FROM User_Event_tbl WHERE event_id = :event_id', $parameters);
	return $allgroups->fetchAll();

}

function addUserToEvent($pdo, $userid, $eventid, $owner)
{
	$query = 'INSERT INTO User_Event_tbl (user_id, event_id, is_event_owner)
	VALUES (:user_id, :event_id, :is_event_owner)';
	$parameters = [':user_id' => $userid, ':event_id' => $eventid, ':is_event_owner' => $owner];
	query($pdo, $query, $parameters);
}


function deleteUserFromEvent($pdo, $userid, $eventid)
{
	$parameters = [':user_id' => $userid, 'event_id' => $eventid];
	query($pdo, 'DELETE FROM User_Event_tbl WHERE user_id = :user_id AND event_id = :event_id', $parameters);
}


function getEventsByIdJoin($pdo, $userid)
{
	$parameters = [':user_id' => $userid];
	$groups = query($pdo, 'SELECT Event_tbl.event_id, Event_tbl.event_name, Event_tbl.event_location, Event_tbl.event_datetime, 
	User_Event_tbl.user_id, User_Event_tbl.event_id, User_Event_tbl.is_event_owner FROM (Event_tbl INNER JOIN User_Event_tbl 
	ON User_Event_tbl.event_id = Event_tbl.event_id) WHERE user_id = :user_id ORDER BY Event_tbl.event_datetime', $parameters);
	return $groups->fetchAll();
}


function getGroupsByIdJoin($pdo, $userid)
{
	$parameters = [':user_id' => $userid];
	$groups = query($pdo, 'SELECT Group_tbl.group_id, Group_tbl.group_name, Group_tbl.group_details, Group_tbl.group_region, 
	User_Group_tbl.user_id, User_Group_tbl.group_id, User_Group_tbl.is_group_owner FROM (Group_tbl INNER JOIN User_Group_tbl 
	ON User_Group_tbl.group_id = Group_tbl.group_id) WHERE user_id = :user_id', $parameters);
	return $groups->fetchAll();
}


function getEventCommentsById($pdo, $eventid)
{
	$parameters = [':event_id' => $eventid];
	$groups = query($pdo, 'SELECT Event_Comments_tbl.user_id, Event_Comments_tbl.event_id, Event_Comments_tbl.comment_content, 
	Event_Comments_tbl.comment_date, User_tbl.first_name, User_tbl.last_name, User_tbl.user_id, Event_Comments_tbl.event_comments_id FROM (Event_Comments_tbl INNER JOIN User_tbl
	ON Event_Comments_tbl.user_id = User_tbl.user_id) WHERE event_id = :event_id ORDER BY Event_Comments_tbl.comment_date', $parameters);
	return $groups->fetchAll();
}

function insertCommentByUserId($pdo, $userid, $eventid, $commentcontent)
{
	$query = 'INSERT INTO Event_Comments_tbl (user_id, event_id, comment_content)
	VALUES (:user_id, :event_id, :comment_content)';
	$parameters = [':user_id' => $userid, ':event_id' => $eventid, ':comment_content' => $commentcontent];
	query($pdo, $query, $parameters);
}

function deleteComment($pdo, $eventcommentid)
{
	$parameters = [':event_comments_id' => $eventcommentid];
	query($pdo, 'DELETE FROM Event_Comments_tbl WHERE event_comments_id = :event_comments_id', $parameters);
}

function getEventFromCommentId($pdo, $eventcommentid)
{
	$parameters = [':event_comments_id' => $eventcommentid];
	$query = query($pdo, 'SELECT DISTINCT event_id FROM Event_Comments_tbl
    WHERE event_comments_id = :event_comments_id', $parameters);
	$row = $query->fetch();
	return $row[0];

}

function countEventComments($pdo, $eventid)
{
	$parameters = [':event_id' => $eventid];
	$query = query($pdo, 'SELECT COUNT(*) FROM Event_Comments_tbl
    WHERE event_id = :event_id', $parameters);
	$row = $query->fetch();
	return $row[0];

}

function countEvents($pdo)
{
	$query = query($pdo, 'SELECT COUNT(*) FROM Event_tbl');
	$row = $query->fetch();
	return $row[0];

}

function getPageEvents($pdo, $start, $end)
{
	$parameters = [':startlim' => $start, ':endlim' => $end];
	$groups = query($pdo, 'SELECT * FROM Event_tbl LIMIT :startlim, :endlim', $parameters);
	return $groups->fetchAll();
}

function getPageGroups($pdo, $start, $end)
{
	$parameters = [':startlim' => $start, ':endlim' => $end];
	$groups = query($pdo, 'SELECT * FROM Group_tbl LIMIT :startlim, :endlim', $parameters);
	return $groups->fetchAll();
}

function countGroups($pdo)
{
	$query = query($pdo, 'SELECT COUNT(*) FROM Group_tbl');
	$row = $query->fetch();
	return $row[0];

}

function getGroupPersonNames($pdo, $groupid)
{
	$parameters = [':group_id' => $groupid];
	$allgroups = query($pdo, 'SELECT User_Group_tbl.group_id, User_Group_tbl.user_id, User_tbl.first_name, User_tbl.last_name, User_tbl.user_id
	FROM User_tbl INNER JOIN User_Group_tbl ON User_Group_tbl.user_id = User_tbl.user_id WHERE group_id = :group_id', $parameters);
	return $allgroups->fetchAll();

}
function getEventFirstNames($pdo, $eventid)
{
	$parameters = [':event_id' => $eventid];
	$allgroups = query($pdo, 'SELECT User_tbl.first_name, User_tbl.last_name, User_Event_tbl.user_id, User_tbl.user_id, User_Event_tbl.event_id 
	FROM User_tbl INNER JOIN User_Event_tbl ON User_Event_tbl.user_id = User_tbl.user_id WHERE User_Event_tbl.event_id = :event_id ', $parameters);
	return $allgroups->fetchAll();

}

function countRegistered($pdo, $eventid)
{
	$parameters = [':event_id' => $eventid];
	$query = query($pdo, 'SELECT COUNT(*) FROM User_Event_tbl WHERE event_id = :event_id', $parameters);
	$row = $query->fetch();
	return $row[0];

}

function getEventOwnerName($pdo, $eventid)
{
	$parameters = [':event_id' => $eventid];
	$allgroups = query($pdo, 'SELECT User_Event_tbl.event_id, User_Event_tbl.is_event_owner, User_Event_tbl.user_id, User_tbl.first_name, User_tbl.last_name
	FROM User_tbl INNER JOIN User_Event_tbl ON User_Event_tbl.user_id = User_tbl.user_id WHERE event_id = :event_id AND is_event_owner = "YES"', $parameters);
	return $allgroups->fetchAll();

}


function groupNameexists($pdo, $groupname)
{
	$parameters = [':group_name' => $groupname];
	$users = query($pdo, 'SELECT group_name FROM Group_tbl WHERE group_name = :group_name', $parameters);
	return $users->fetchAll();
}

function insertGroup($pdo, $groupname, $groupdetails, $groupicon, $groupregion)
{
	$query = 'INSERT INTO Group_tbl (group_name, group_details, group_icon, group_region)
	VALUES (:group_name, :group_details, :group_icon, :group_region)';
	$parameters = [':group_name' => $groupname, ':group_details' => $groupdetails, ':group_icon' => $groupicon, ':group_region' => $groupregion];
	query($pdo, $query, $parameters);
}

function getGroupIdByName($pdo, $groupname)
{
	$parameters = [':group_name' => $groupname];
	$allgroups = query($pdo, 'SELECT group_id FROM Group_tbl WHERE group_name = :group_name', $parameters);
	return $allgroups->fetchAll();

}

function insertOwnerStatus($pdo, $groupid, $userid, $isowner)
{
	$query = 'INSERT INTO User_Group_tbl (group_id, user_id, is_group_owner)
	VALUES (:group_id, :user_id, :is_group_owner)';
	$parameters = [':group_id' => $groupid, ':user_id' => $userid, ':is_group_owner' => $isowner];
	query($pdo, $query, $parameters);
}


function allEvents($pdo)
{
	$allevents = query($pdo, 'SELECT * From Event_tbl');
	return $allevents->fetchAll();
}


//Profile filter queries - GROUPS
function getGroupsByIdJoin_Filter($pdo, $userid, $afilter)
{
	$parameters = [':user_id' => $userid];
	$groups = query($pdo, 'SELECT Group_tbl.group_id, Group_tbl.group_name, Group_tbl.group_details, User_Group_tbl.user_id, Group_tbl.group_region,
	User_Group_tbl.is_group_owner FROM (Group_tbl INNER JOIN User_Group_tbl 
	ON User_Group_tbl.group_id = Group_tbl.group_id) WHERE user_id = :user_id ORDER BY ' . $afilter . ' ASC', $parameters);
	return $groups->fetchAll();
}



//Profile filter queries - EVENTS
function getEventsByIdJoin_Filter($pdo, $userid, $afilter)
{
	$parameters = [':user_id' => $userid];
	$groups = query($pdo, 'SELECT Event_tbl.event_name, Event_tbl.event_details, Event_tbl.event_location, Event_tbl.event_datetime, 
	User_Event_tbl.user_id, User_Event_tbl.event_id, User_Event_tbl.is_event_owner, Event_tbl.event_type
	FROM Event_tbl INNER JOIN User_Event_tbl ON User_Event_tbl.event_id = Event_tbl.event_id WHERE user_id = :user_id ORDER BY ' . $afilter . ' ASC', $parameters);
	return $groups->fetchAll();
}

//Event search filter query
function getEventsByIdJoin_FilterIntoPages($pdo, $afilter, $start, $end)
{
	$parameters = [':startlim' => $start, ':endlim' => $end, ':afilter' => $afilter];
	$groups = query($pdo, 'SELECT * FROM Event_tbl ORDER BY :afilter ASC LIMIT :startlim, :endlim', $parameters);
	return $groups->fetchAll();
}



function getEventIdByName($pdo, $eventname)
{
	$parameters = [':event_name' => $eventname];
	$query = query($pdo, 'SELECT event_id FROM Event_tbl WHERE event_name = :event_name', $parameters);
	$row = $query->fetch();
	return $row[0];
}




function insertEvent($pdo, $eventname, $eventdatetime, $eventdetails, $eventlocation, $eventtype, $eventcapacity, $eventgrouphost)
{
	$query = 'INSERT INTO Event_tbl (event_name, event_datetime, event_details, event_location, event_type, event_capacity, group_id)
	VALUES (:event_name, :event_datetime, :event_details, :event_location, :event_type, :event_capacity, :group_id)';
	$parameters = [
		':event_name' => $eventname,
		':event_datetime' => $eventdatetime,
		':event_details' => $eventdetails,
		':event_location' => $eventlocation,
		':event_type' => $eventtype,
		':event_capacity' => $eventcapacity,
		':group_id' => $eventgrouphost
	];
	query($pdo, $query, $parameters);
}

function eventNameexists($pdo, $eventname)
{
	$parameters = [':event_name' => $eventname];
	$users = query($pdo, 'SELECT event_name FROM Event_tbl WHERE event_name = :event_name', $parameters);
	return $users->fetchAll();
}

function deleteEvent($pdo, $eventid)
{
	$parameters = [':event_id' => $eventid];
	query($pdo, 'DELETE FROM Event_tbl WHERE event_id = :event_id', $parameters);
}

function deleteGroup($pdo, $groupid)
{
	$parameters = [':group_id' => $groupid];
	query($pdo, 'DELETE FROM Group_tbl WHERE group_id = :group_id', $parameters);
}

//event page search queries and totals of search queries - for pagination


function getOwnedGroups($pdo, $userid)
{
	$parameters = [':user_id' => $userid];
	$groups = query($pdo, 'SELECT Group_tbl.group_id, Group_tbl.group_name, Group_tbl.group_details, User_Group_tbl.user_id, 
User_Group_tbl.is_group_owner FROM (Group_tbl INNER JOIN User_Group_tbl 
ON User_Group_tbl.group_id = Group_tbl.group_id) WHERE user_id = :user_id AND is_group_owner = "YES"', $parameters);
	return $groups->fetchAll();
}

function countEventsFiltered($pdo)
{
	$query = query($pdo, 'SELECT COUNT(*) FROM Event_tbl');
	$row = $query->fetch();
	return $row[0];

}

function countEventsFiltered_eventname($pdo, $pattern)
{
	$pattern = '%' . $pattern . '%';
	$parameters = [':pattern' => $pattern];
	$query = query($pdo, 'SELECT COUNT(*) FROM Event_tbl WHERE event_name LIKE :pattern', $parameters);
	$row = $query->fetch();
	return $row[0];

}

function countEventsFiltered_eventlocation($pdo, $pattern)
{
	$pattern = '%' . $pattern . '%';
	$parameters = [':pattern' => $pattern];
	$query = query($pdo, 'SELECT COUNT(*) FROM Event_tbl WHERE event_location LIKE :pattern', $parameters);
	$row = $query->fetch();
	return $row[0];

}

function countEventsFiltered_eventdate($pdo, $pattern)
{
	$pattern = '%' . $pattern . '%';
	$parameters = [':pattern' => $pattern];
	$query = query($pdo, 'SELECT COUNT(*) FROM Event_tbl WHERE event_datetime LIKE :pattern', $parameters);
	$row = $query->fetch();
	return $row[0];

}



function searchPageEvents_eventlocation($pdo, $pattern, $start, $end)
{
	$pattern = '%' . $pattern . '%';
	$parameters = [':pattern' => $pattern, ':startlim' => $start, ':endlim' => $end];
	$groups = query($pdo, "SELECT * FROM Event_tbl WHERE event_location LIKE :pattern ORDER BY event_location ASC LIMIT :startlim, :endlim", $parameters);
	return $groups->fetchAll();
}
function searchPageEvents_eventdate($pdo, $pattern, $start, $end)
{
	$pattern = '%' . $pattern . '%';
	$parameters = [':pattern' => $pattern, ':startlim' => $start, ':endlim' => $end];
	$groups = query($pdo, "SELECT * FROM Event_tbl WHERE event_datetime LIKE :pattern ORDER BY event_datetime ASC LIMIT :startlim, :endlim", $parameters);
	return $groups->fetchAll();
}
function searchPageEvents_eventowned($pdo, $pattern, $start, $end, $userid)
{
	$pattern = '%' . $pattern . '%';
	$parameters = [':pattern' => $pattern, ':startlim' => $start, ':endlim' => $end, ':user_id' => $userid];
	$groups = query($pdo, "SELECT Event_tbl.event_id, Event_tbl.event_name, Event_tbl.event_type, Event_tbl.event_details, 
	Event_tbl.event_location, Event_tbl.event_datetime, Event_tbl.event_capacity, Event_tbl.group_id, User_Event_tbl.is_event_owner, User_Event_tbl.user_id
	FROM Event_tbl INNER JOIN User_Event_tbl ON User_Event_tbl.event_id = Event_tbl.event_id WHERE user_id=:user_id AND is_event_owner ='YES' AND event_name LIKE :pattern ORDER BY event_name ASC LIMIT :startlim, :endlim;", $parameters);
	return $groups->fetchAll();
}
function searchPageEvents($pdo, $start, $end)
{
	$parameters = [':startlim' => $start, ':endlim' => $end];
	$groups = query($pdo, "SELECT * FROM Event_tbl LIMIT :startlim, :endlim", $parameters);
	return $groups->fetchAll();
}

function countEventsFiltered_eventowned($pdo, $pattern, $userid)
{
	$pattern = '%' . $pattern . '%';
	$parameters = [':pattern' => $pattern, ':user_id' => $userid];
	$query = query($pdo, "SELECT Event_tbl.event_id, Event_tbl.event_name, Event_tbl.event_type, Event_tbl.event_details, 
	Event_tbl.event_location, Event_tbl.event_datetime, Event_tbl.event_capacity, Event_tbl.group_id, User_Event_tbl.is_event_owner, User_Event_tbl.user_id
	FROM Event_tbl INNER JOIN User_Event_tbl ON User_Event_tbl.event_id = Event_tbl.event_id WHERE user_id=:user_id AND User_Event_tbl.is_event_owner ='YES' AND event_name LIKE :pattern", $parameters);
	return $query->fetchAll();


}

function countGroupsFiltered_groupname($pdo, $pattern)
{
	$pattern = '%' . $pattern . '%';
	$parameters = [':pattern' => $pattern];
	$query = query($pdo, 'SELECT COUNT(*) FROM Group_tbl WHERE group_name LIKE :pattern', $parameters);
	$row = $query->fetch();
	return $row[0];

}

function countGroupsFiltered_groupdetails($pdo, $pattern)
{
	$pattern = '%' . $pattern . '%';
	$parameters = [':pattern' => $pattern];
	$query = query($pdo, 'SELECT COUNT(*) FROM Group_tbl WHERE group_details LIKE :pattern', $parameters);
	$row = $query->fetch();
	return $row[0];

}

function searchPageGroups_groupname($pdo, $pattern, $start, $end)
{
	$pattern = '%' . $pattern . '%';
	$parameters = [':pattern' => $pattern, ':startlim' => $start, ':endlim' => $end];
	$groups = query($pdo, "SELECT * FROM Group_tbl WHERE group_name LIKE :pattern ORDER BY group_name ASC LIMIT :startlim, :endlim", $parameters);
	return $groups->fetchAll();
}

function searchPageGroups_groupdetails($pdo, $pattern, $start, $end)
{
	$pattern = '%' . $pattern . '%';
	$parameters = [':pattern' => $pattern, ':startlim' => $start, ':endlim' => $end];
	$groups = query($pdo, "SELECT * FROM Group_tbl WHERE group_details LIKE :pattern ORDER BY group_details ASC LIMIT :startlim, :endlim", $parameters);
	return $groups->fetchAll();
}


function getEventByEventId_JoinGroup($pdo, $eventid)
{
	$parameters = [':event_id' => $eventid];
	$event = query($pdo, 'SELECT Event_tbl.event_id, Event_tbl.group_id, Group_tbl.group_icon, Group_tbl.group_name
	FROM Event_tbl INNER JOIN Group_tbl ON Event_tbl.group_id = Group_tbl.group_id WHERE event_id = :event_id', $parameters);
	return $event->fetchAll();
}

function getGroupicon($pdo, $groupid)
{
	$parameters = [':group_id' => $groupid];
	$event = query($pdo, 'SELECT * FROM Group_tbl WHERE group_id = :group_id', $parameters);
	return $event->fetchAll();
}

function updateGroupname($pdo, $groupname, $groupid)
{
	$parameters = [':group_name' => $groupname, ':group_id' => $groupid];

	query($pdo, 'UPDATE Group_tbl SET group_name = COALESCE(:group_name, group_name) WHERE group_id = :group_id', $parameters);
}

function updateGroupdetails($pdo, $groupdetails, $groupid)
{
	$parameters = [':group_details' => $groupdetails, ':group_id' => $groupid];

	query($pdo, 'UPDATE Group_tbl SET group_details = COALESCE(:group_details, group_details) WHERE group_id = :group_id', $parameters);
}

function updateGroupicon($pdo, $groupicon, $groupid)
{
	$parameters = [':group_icon' => $groupicon, ':group_id' => $groupid];

	query($pdo, 'UPDATE Group_tbl SET group_icon = COALESCE(:group_icon, group_icon) WHERE group_id = :group_id', $parameters);
}

function insertGroupEvent($pdo, $groupid, $eventid)
{

	$query = 'INSERT INTO Group_Event_tbl (group_id, event_id) VALUES (:group_id, :event_id)';
	$parameters = [':group_id' => $groupid, ':event_id' => $eventid];
	query($pdo, $query, $parameters);

}

function insertOwnerStatusEvent($pdo, $eventid, $userid, $isowner)
{
	$query = 'INSERT INTO User_Event_tbl (event_id, user_id, is_event_owner) VALUES (:event_id, :user_id, :is_event_owner)';
	$parameters = [':event_id' => $eventid, ':user_id' => $userid, ':is_event_owner' => $isowner];
	query($pdo, $query, $parameters);
}

function getGroupEvents($pdo, $groupid)
{

	$parameters = [':group_id' => $groupid];
	$query = query($pdo, 'SELECT Event_tbl.*, Group_Event_tbl.event_id, Group_Event_tbl.group_id FROM Event_tbl INNER JOIN Group_Event_tbl 
	ON Group_Event_tbl.event_id = Event_tbl.event_id WHERE Group_Event_tbl.group_id = :group_id', $parameters);
	return $query->fetchAll();
}

function searchPageEvents_eventname($pdo, $pattern, $start, $end)
{
	$pattern = '%' . $pattern . '%';
	$parameters = [':pattern' => $pattern, ':startlim' => $start, ':endlim' => $end];
	$groups = query($pdo, "SELECT * FROM Event_tbl WHERE event_name LIKE :pattern ORDER BY event_name ASC LIMIT :startlim, :endlim", $parameters);
	return $groups->fetchAll();
}


function getEventComment($pdo, $eventcommentid)
{
	$parameters = [':event_comments_id' => $eventcommentid];
	$groups = query($pdo, 'SELECT Event_Comments_tbl.user_id, Event_Comments_tbl.event_id, Event_Comments_tbl.comment_content, 
	Event_Comments_tbl.comment_date, User_tbl.first_name, User_tbl.last_name, User_tbl.user_id, Event_Comments_tbl.event_comments_id FROM (Event_Comments_tbl INNER JOIN User_tbl
	ON Event_Comments_tbl.user_id = User_tbl.user_id) WHERE event_comments_id = :event_comments_id ORDER BY Event_Comments_tbl.comment_date', $parameters);
	return $groups->fetchAll();
}

function insertReport($pdo, $reportby, $reportfor, $commentcontent, $reason, $reportdetails, $commentid)
{
	$query = 'INSERT INTO Report_tbl (report_by,  report_for, report_comment_content, report_reason, report_details, event_comments_id)
	VALUES (:report_by, :report_for, :report_comment_content, :report_reason, :report_details, :event_comments_id)';
	$parameters = [':report_by' => $reportby, ':report_for' => $reportfor, ':report_comment_content' => $commentcontent, ':report_reason' => $reason, ':report_details' => $reportdetails, ':event_comments_id' => $commentid];
	query($pdo, $query, $parameters);
}

function insertToDeletedAccountTable($pdo, $firstname, $lastname, $username, $password, $userid)
{
	$query = 'INSERT INTO Deleted_Accounts_tbl (first_name, last_name, user_name, user_password, user_id)
	VALUES (:first_name, :last_name, :user_name, :user_password, :user_id)';
	$parameters = [':first_name' => $firstname, ':last_name' => $lastname, ':user_name' => $username, ':user_password' => $password, ':user_id' => $userid];
	query($pdo, $query, $parameters);
}

function countGroupMembers($pdo, $groupid)
{
	$parameters = [':group_id' => $groupid];
	$query = query($pdo, 'SELECT COUNT(*) FROM User_Group_tbl WHERE group_id = :group_id', $parameters);
	$row = $query->fetch();
	return $row[0];

}

function allUsers($pdo)
{
	$alluserdata = query($pdo, 'SELECT * From User_tbl');
	return $alluserdata->fetchAll();
}



function getReports($pdo)
{
	$groups = query($pdo, 'SELECT * FROM Report_tbl');
	return $groups->fetchAll();
}



function updateEvent($pdo, $eventname, $eventtype, $eventdetails, $eventlocation, $eventdatetime, $eventcapacity, $groupid, $eventid)
{

	$parameters = [':event_name' => $eventname, ':event_type' => $eventtype, ':event_details' => $eventdetails, ':event_location' => $eventlocation, ':event_datetime' => $eventdatetime, ':event_capacity' => $eventcapacity, ':group_id' => $groupid, ':event_id' => $eventid];
	query($pdo, 'UPDATE Event_tbl SET event_name = COALESCE(:event_name, event_name), 
	event_type = COALESCE(:event_type, event_type),
	event_details = COALESCE(:event_details, event_details), 
	event_location = COALESCE(:event_location, event_location),
	event_datetime = COALESCE(:event_datetime, event_datetime),
	event_capacity = COALESCE(:event_capacity, event_capacity),
	group_id = COALESCE(:group_id, group_id)
	WHERE event_id = :event_id', $parameters);
}

function getGroupsByGroupId($pdo, $groupid)
{
	$parameters = [':group_id' => $groupid];
	$groups = query($pdo, 'SELECT * From Group_tbl WHERE group_id = :group_id', $parameters);
	return $groups->fetchAll();
}


function allEventsJoinedUser($pdo)
{
	$allevents = query($pdo, 'SELECT * FROM Event_tbl INNER JOIN User_Event_tbl 
	ON User_Event_tbl.event_id = Event_tbl.event_id
    INNER JOIN User_tbl 
	ON User_tbl.user_id = User_Event_tbl.user_id
    WHERE User_Event_tbl.is_event_owner = "YES"');
	return $allevents->fetchAll();
}

function getEvents_Filtered($pdo, $afilter)
{
	$groups = query($pdo, 'SELECT * FROM Event_tbl INNER JOIN User_Event_tbl 
	ON User_Event_tbl.event_id = Event_tbl.event_id
    INNER JOIN User_tbl 
	ON User_tbl.user_id = User_Event_tbl.user_id
    WHERE User_Event_tbl.is_event_owner = "YES" ORDER BY ' . $afilter . ' ASC');
	return $groups->fetchAll();
}

function allEventsJoinedUser_Filtered($pdo, $afilter)
{
	$allevents = query($pdo, 'SELECT Event_tbl.*, User_Event_tbl.* FROM Event_tbl INNER JOIN User_Event_tbl 
	ON User_Event_tbl.event_id = Event_tbl.event_id WHERE User_Event_tbl.is_event_owner = "YES" ORDER BY ' . $afilter . ' ASC');
	return $allevents->fetchAll();
}

function allUsers_Filtered($pdo, $afilter)
{
	$alluserdata = query($pdo, 'SELECT * From User_tbl ORDER BY ' . $afilter . ' ASC');
	return $alluserdata->fetchAll();
}


function allGroups_Owners($pdo)
{
	$groups = query($pdo, 'SELECT * FROM Group_tbl 
	INNER JOIN User_Group_tbl ON User_Group_tbl.group_id = Group_tbl.group_id
    INNER JOIN User_tbl ON User_tbl.user_id = User_Group_tbl.user_id WHERE is_group_owner = "YES"');
	return $groups->fetchAll();
}

function allGroups_Owners_Filtered($pdo, $afilter)
{
	$groups = query($pdo, 'SELECT * FROM Group_tbl 
	INNER JOIN User_Group_tbl ON User_Group_tbl.group_id = Group_tbl.group_id
    INNER JOIN User_tbl ON User_tbl.user_id = User_Group_tbl.user_id WHERE is_group_owner = "YES" ORDER BY ' . $afilter . ' ASC');
	return $groups->fetchAll();
}


function updateGroup($pdo, $groupname, $groupregion, $groupdetails, $groupicon, $groupid)
{

	$parameters = [':group_name' => $groupname, ':group_region' => $groupregion,':group_details' => $groupdetails,':group_icon' => $groupicon, ':group_id' => $groupid];
	query($pdo, 'UPDATE Group_tbl SET group_name = COALESCE(:group_name, group_name), 
	group_region = COALESCE(:group_region, group_region),
	group_details = COALESCE(:group_details, group_details), 
	group_icon = COALESCE(:group_icon, group_icon)
	WHERE group_id = :group_id', $parameters);
}

function countGroupsFiltered_groupregion($pdo, $pattern)
{
	$pattern = '%' . $pattern . '%';
	$parameters = [':pattern' => $pattern];
	$query = query($pdo, 'SELECT COUNT(*) FROM Group_tbl WHERE group_region LIKE :pattern', $parameters);
	$row = $query->fetch();
	return $row[0];

}


function searchPageGroups_groupregion($pdo, $pattern, $start, $end)
{
	$pattern = '%' . $pattern . '%';
	$parameters = [':pattern' => $pattern, ':startlim' => $start, ':endlim' => $end];
	$groups = query($pdo, "SELECT * FROM Group_tbl WHERE group_region LIKE :pattern ORDER BY group_region ASC LIMIT :startlim, :endlim", $parameters);
	return $groups->fetchAll();
}



function allSponsors($pdo)
{
	$groups = query($pdo, "SELECT * FROM Sponsor_tbl");
	return $groups->fetchAll();
}

function deleteSponsor($pdo, $sp_id)
{
	$parameters = [':sponsor_id' => $sp_id];
	query($pdo, 'DELETE FROM Sponsor_tbl WHERE sponsor_id = :sponsor_id', $parameters);
}



function sponsorNameexists($pdo, $sp_name)
{
	$parameters = [':sponsor_name' => $sp_name];
	$users = query($pdo, 'SELECT sponsor_name FROM Sponsor_tbl WHERE sponsor_name = :sponsor_name', $parameters);
	return $users->fetchAll();
}


function createSponsor($pdo, $sp_name, $sp_description, $sp_type)
{
	$query = 'INSERT INTO Sponsor_tbl (sponsor_name, sponsor_description, sponsor_type)
	VALUES (:sponsor_name, :sponsor_description, :sponsor_type)';
	$parameters = [':sponsor_name' => $sp_name, ':sponsor_description' => $sp_description, ':sponsor_type' => $sp_type];
	query($pdo, $query, $parameters);
}

function allSponsors_Filtered($pdo, $afilter)
{
	$alluserdata = query($pdo, 'SELECT * From Sponsor_tbl ORDER BY ' . $afilter . ' ASC');
	return $alluserdata->fetchAll();
}


function createEventSponsor($pdo, $sponsorid, $eventid, $sp_description, $sp_discount, $sp_img, $sp_hyperlink)
{

	$query = 'INSERT INTO Event_Sponsor_tbl (sponsor_id, event_id, sp_description, sp_discount, sp_img, sp_hyperlink)
	VALUES (:sponsor_id, :event_id, :sp_description, :sp_discount, :sp_img, :sp_hyperlink)';
	$parameters = [':sponsor_id' => $sponsorid, ':event_id' => $eventid, ':sp_description' => $sp_description, ':sp_discount' => $sp_discount, ':sp_img' => $sp_img, 'sp_hyperlink' => $sp_hyperlink];
	query($pdo, $query, $parameters);
}


function getSponsorIdByName($pdo, $sp_name)
{
	
	$parameters = [':sponsor_name' => $sp_name];
	$query = query($pdo, 'SELECT sponsor_id FROM Sponsor_tbl WHERE sponsor_name = :sponsor_name', $parameters);
	$row = $query->fetch();
	return $row[0];

}


function eventSponsorDetails($pdo, $event_id)

{	$parameters = [':event_id' => $event_id];
	$groups = query($pdo, 'SELECT * FROM Sponsor_tbl
	INNER JOIN Event_Sponsor_tbl ON Sponsor_tbl.sponsor_id = Event_Sponsor_tbl.sponsor_id WHERE event_id = :event_id', $parameters);
	return $groups->fetchAll();
}

function eventSponsorNames($pdo, $event_id)

{	$parameters = [':event_id' => $event_id];
	$groups = query($pdo, 'SELECT DISTINCT sponsor_name, sponsor_description FROM Sponsor_tbl
	INNER JOIN Event_Sponsor_tbl ON Sponsor_tbl.sponsor_id = Event_Sponsor_tbl.sponsor_id WHERE event_id = :event_id', $parameters);
	return $groups->fetchAll();
}

function sponsorProducts($pdo, $sp_name, $event_id)

{	$parameters = [':sponsor_name' => $sp_name, ':event_id' => $event_id];
	$groups = query($pdo, 'SELECT * FROM Sponsor_tbl
	INNER JOIN Event_Sponsor_tbl ON Sponsor_tbl.sponsor_id = Event_Sponsor_tbl.sponsor_id WHERE event_id = :event_id AND sponsor_name = :sponsor_name', $parameters);
	return $groups->fetchAll();
}

function deleteProductFromEvent($pdo, $event_sp_id)
{
	$parameters = [':event_sponsor_id' => $event_sp_id];
	query($pdo, 'DELETE FROM Event_Sponsor_tbl WHERE event_sponsor_id = :event_sponsor_id', $parameters);
}