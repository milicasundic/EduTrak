<?php

	$contact = new Contact($id);
	$note = new Note();

    if($contact->exists()){

        $contactTypes = array('Employee','Partner','Partner Rep','School','Company','');
        $prefixes = array('Mr.','Ms.','Mrs.','Fr.','Sr.','Dr.','');

?>

<div class="contact-information">
	<div class="contact-sidebar-information">
	
		<div class="contact-sidebar-information-name">
			<i class="fas fa-id-badge"></i>
			<span><?php echo $contact->data()->prefix .' '. $contact->data()->firstName .' '. $contact->data()->lastName?></span>
		</div>
		
		<div class="contact-sidebar-information-submenu">
			<a href="tel:01<?php echo $contact->data()->mobilePhone ?>"><i class="fas fa-phone"></i></a>
			<a href="https://mail.google.com/mail/?view=cm&fs=1&to=<?php echo $contact->data()->email ?>" target="_blank"><i class="fas fa-envelope"></i></a>
			<a href="#delete"><i class="fas fa-trash"></i></a>
		</div>
		
		<div class="contact-sidebar-information-h6">
			<h6>Contact ID</h6>
			<span><?php echo $contact->data()->id ?></span>
		</div>
		
		<div class="contact-sidebar-information-h6">
			<h6>Last Contacted</h6>
			<span><?php echo $contact->data()->lastContacted ?></span>
		</div>
		
		<div class="contact-sidebar-information-h6">
			<h6>Created By</h6>
			<span><?php echo $contact->data()->createdBy ?></span>
		</div>
		
		<div class="contact-sidebar-information-h6">
			<h6>Created On</h6>
			<span><?php echo $contact->data()->createdOn ?></span>
		</div>
		
		<div class="contact-sidebar-information-h6">
			<h6>Modified By</h6>
			<span><?php echo $contact->data()->modifiedBy ?></span>
		</div>
		
		<div class="contact-sidebar-information-h6">
			<h6>Modified On</h6>
			<span><?php echo $contact->data()->modifiedOn ?></span>
		</div>
	
	</div>
	<div class="contact-header-information contact-tab">
		<button class="contact-tablinks" onclick="openCity(event, 'contact-information', 'block')" id="<?php if(Session::exists('home')){echo 'defaultOpen';}else{echo 'defaultOpen';} ?>"><i class="fas fa-info"></i>Information</button>
  <button class="contact-tablinks" onclick="openCity(event, 'contact-notes', 'grid')" id="<?php if(Session::exists('home')){ echo 'defaultOpen';} ?>"><i class="fas fa-sticky-note"></i>Notes (<?php echo $contact->countNotes($contact->data()->id, 'contact')?>)</button>
  <button class="contact-tablinks" onclick="openCity(event, 'contact-mails', 'grid')"><i class="fas fa-envelope"></i>Email</button>
	</div>
	
	<form action="updateContact.php" method="post" class="contact-form-information contact-tabcontent" id="contact-information">
		<input type="hidden" name="contactId" value="<?php echo $contact->data()->id ?>">

        <div class="contact-form-information-row">
            <div class="contact-form-information-cell info-form-x-3">
                <label>First Name</label>
                <input type="text" name="firstName" value="<?php echo $contact->data()->firstName; ?>">
            </div>
            <div class="contact-form-information-cell info-form-x-4">
                <label>Last Name</label>
                <input type="text" name="lastName" value="<?php echo $contact->data()->lastName; ?>">
            </div>
            <div class="contact-form-information-cell info-form-x-5">
                <label>Title</label>
                <input type="text" name="jobTitle" value="<?php echo $contact->data()->jobTitle; ?>">
            </div>
        </div>

        <div class="contact-form-information-row">
            <div class="contact-form-information-cell info-form-x-3">
                <label>Category</label>
                <select id="lead-category" name="category">
                    <?php

                        foreach ($contact->getCategories() as $item){
                            if($item->category == $contact->data()->category){
                                echo "<option value='".$item->category."' selected>".$item->category."</option>";
                            }else{
                                echo "<option value='".$item->category."'>".$item->category."</option>";
                            }
                        }

                    ?>
                </select>
            </div>
            <div class="contact-form-information-cell info-form-x-6">
                <label>Customer Name</label>
                <input id="updateCustomer" onfocus="getCustomers(this)" onkeyup="getCustomers(this)" class="autocomplete-input" type="text" name="customer" value="<?php echo $contact->data()->customer; ?>">
                <div style="width: 100%" class="autocomplete-wrapper"></div>
            </div>
            <div class="contact-form-information-cell info-form-x-3">
                <label></label>
                <button type="button" onclick="connect()" class="assignCustomer"><i class="fas fa-link"></i></button>
            </div>
        </div>

        <div class="contact-form-information-row">
            <div class="contact-form-information-cell info-form-x-8">
                <label>Email</label>
                <input type="text" name="email" value="<?php echo $contact->data()->email; ?>">
            </div>
        </div>

        <div class="contact-form-information-row">
            <div class="contact-form-information-cell info-form-x-5">
                <label>Office Phone</label>
                <input type="text" name="officePhone" value="<?php echo $contact->data()->officePhone; ?>">
            </div>
            <div class="contact-form-information-cell info-form-x-2">
                <label>Extension</label>
                <input type="text" name="phoneExt" value="<?php echo $contact->data()->phoneExt; ?>">
            </div>
            <div class="contact-form-information-cell info-form-x-5">
                <label>Mobile Phone</label>
                <input type="text" name="mobilePhone" value="<?php echo $contact->data()->mobilePhone; ?>">
            </div>
        </div>

        <div class="contact-form-information-row">
            <div class="contact-form-information-cell info-form-x-6">
                <label>Street</label>
                <input type="text" name="street" value="<?php echo $contact->data()->street; ?>">
            </div>
            <div class="contact-form-information-cell info-form-x-4">
                <label>City</label>
                <input type="text" name="city" value="<?php echo $contact->data()->city; ?>">
            </div>
        </div>

        <div class="contact-form-information-row">
            <div class="contact-form-information-cell info-form-x-3">
                <label>State</label>
                <input type="text" name="state" value="<?php echo $contact->data()->state; ?>">
            </div>
            <div class="contact-form-information-cell info-form-x-2">
                <label>Zip</label>
                <input type="text" name="zip" value="<?php echo $contact->data()->zip; ?>">
            </div>
            <div class="contact-form-information-cell info-form-x-4">
                <label>Country</label>
                <input type="text" name="country" value="<?php echo $contact->data()->country; ?>">
            </div>
        </div>

        <div class="contact-form-information-row">
            <div class="contact-form-information-cell info-form-x-12">
                <label>Tags</label>
                <input type="text" name="tags" value="<?php echo $contact->data()->tags; ?>">
            </div>
        </div>

        <div class="contact-form-information-big-row">
            <div class="contact-form-information-cell info-form-y-4 info-form-x-7">
                <label>Description</label>
                <textarea name="description"><?php echo $contact->data()->description; ?></textarea>
            </div>
            <div class="contact-form-information-cell info-form-x-5">
                <label>Facebook</label>
                <input type="text" name="facebook" value="<?php echo $contact->data()->facebook; ?>">
            </div>
            <div class="contact-form-information-cell info-form-x-5">
                <label>Twitter</label>
                <input type="text" name="twitter" value="<?php echo $contact->data()->twitter; ?>">
            </div>
            <div class="contact-form-information-cell info-form-x-5">
                <label>LinkedIn</label>
                <input type="text" name="linkedIn" value="<?php echo $contact->data()->linkedIn; ?>">
            </div>
            <div class="contact-form-information-cell info-form-x-5">
                <label>Website</label>
                <input type="text" name="website" value="<?php echo $contact->data()->website; ?>">
            </div>
        </div>

        <button class="contact-form-information-save"></button>
        <button onclick="location.href='';" type="button" class="contact-form-information-cancel"></button>

	</form>
	
	<div id="contact-notes" class="contact-notes contact-tabcontent">
	<div class="contact-notes-all">


        <?php

        if($user->hasPermission('user')){
            if(!empty($note->getNotes())) {

                $i = 0;

                foreach ($note->getNotes() as $note) {

                    if ($note->section == 'contact' && $note->contactsID == $id && $note->visibility == 'public') {

                        $noteUser = new User($note->userID);

                        echo "
                    
                        <div class='contact-notes-note'>
	 			<div class='contact-notes-note-header'>
	 				<img src='view/img/profile/" . $noteUser->data()->img . "'>
	 				<h4>" . $noteUser->data()->firstName . " " . $noteUser->data()->lastName . "</h4>";
	 				
	 				if ($note->type == 'call') {
		                            echo "<div><i class='fas fa-phone'></i></div>";
		                        } else {
		                            echo "<div></div>";
		                        }
	 				
	 				if ($note->visibility == 'private') {
		                            echo "<div><i class='fas fa-lock'></i></div>";
		                        } else {
		                            echo "<div><i class='fas fa-eye'></i></div>";
		                        }
		                        
	 			echo "</div>	
	 			<div class='contact-notes-note-content'>
	 				<h4>" . $note->title . "</h4>
	 				<p>
	 					" . $note->content . "
	 				</p>
	 				
	 			</div>
	 			<div class='contact-notes-note-date'>
	 			
	 			<span><a href='#'><i class='fas fa-edit'></i></a></span>
	 			<span><a href='#deleteNote-". $note->id ."'><i class='fas fa-trash'></i></a></span>
	 			
	 					<span>" . $note->createdOn . "</span>
	 				</div>
	 		</div>
                    
                    <!-- REmodal delete note -->
    
    <div class='remodal' data-remodal-id='deleteNote-". $note->id ."'>
        <form action='deleteNote.php' method='post' class='contact-delete-contact'>
        	<h3>Are you sure you want delete this note?</h3>
        	<input type='hidden' name='case' value='". $case ."'>
        	<input type='hidden' name='id' value='". $id ."'>
        	<input type='hidden' name='noteID' value='". $note->id ."'>
                <button type='submit' class='button'><i class='fas fa-trash'></i>Delete</button>
                <button type='button' data-remodal-action='cancel' class='button'><i class='fas fa-ban'></i>Cancel</button>
        </form>
    </div>
                    
                    ";

                    }
                }

            }else{
                echo "No Notes";
            }
        }else{
            if(!empty($note->getNotes())) {

                foreach ($note->getNotes() as $note) {

                    $i = 0;

                    if ($note->section == 'contact' && $note->contactsID == $id) {

                        $noteUser = new User($note->userID);

                        echo "
                    
                        <div class='contact-notes-note'>
	 			<div class='contact-notes-note-header'>
	 				<img src='view/img/profile/" . $noteUser->data()->img . "'>
	 				<h4>" . $noteUser->data()->firstName . " " . $noteUser->data()->lastName . "</h4>";
	 				
	 				if ($note->type == 'call') {
		                            echo "<div><i class='fas fa-phone'></i></div>";
		                        } else {
		                            echo "<div></div>";
		                        }
	 				
	 				if ($note->visibility == 'private') {
		                            echo "<div><i class='fas fa-lock'></i></div>";
		                        } else {
		                            echo "<div><i class='fas fa-eye'></i></div>";
		                        }
	 				
	 			
	 			echo "</div>	
	 			<div class='contact-notes-note-content'>
	 				<h4>" . $note->title . "</h4>
	 				<p>
	 					" . $note->content . "
	 				</p>
	 				
	 			</div>
	 			<div class='contact-notes-note-date'>
	 			
	 			
	 			<span><a href='#'><i class='fas fa-edit'></i></a></span>
	 			<span><a href='#deleteNote-". $note->id ."'><i class='fas fa-trash'></i></a></span>
	 			
	 					<span>" . $note->createdOn . "</span>
	 				</div>
	 		</div>
	 		
	 		<!-- REmodal delete note -->
    
    <div class='remodal' data-remodal-id='deleteNote-". $note->id ."'>
        <form action='deleteNote.php' method='post' class='contact-delete-contact'>
        	<h3>Are you sure you want delete this note?</h3>
        	<input type='hidden' name='case' value='". $case ."'>
        	<input type='hidden' name='id' value='". $id ."'>
        	<input type='hidden' name='noteID' value='". $note->id ."'>
                <button type='submit' class='button'><i class='fas fa-trash'></i>Delete</button>
                <button type='button' data-remodal-action='cancel' class='button'><i class='fas fa-ban'></i>Cancel</button>
        </form>
    </div>
                    
                    ";

                    }

                }

            }else{
                echo "No Notes";
            }
        }




        ?>


	 	</div>
	 	<form class="contact-notes-new" action="addNote.php" method="post">
	 		<h4 class="contact-notes-add-header">
	 			New Note
	 		</h4>
	 		
	 		<input class="contact-notes-add-title" type="text" name="contactNoteTitle" placeholder="Note Title">
	 		<div class="contact-notes-add-private">
	 			<label for="privateNote">
	 				<i class="fas fa-lock"></i>
	 			</label>

                <?php

                    if($user->hasPermission('user')){
                        echo "<input id='privateNote' type='checkbox' style='cursor: not-allowed' disabled name='contactNotePrivate' value='private'>";
                    }else{
                        echo "<input id='privateNote' type='checkbox' name='contactNotePrivate' value='private'>";
                    }

                ?>


	 		</div>
	 		<div class="contact-notes-add-call">
	 			<label for="callNote">
	 				<i class="fas fa-phone"></i>
	 			</label>

                <?php

                    if($user->hasPermission('user')){
                        echo "<input id='callNote' type='checkbox' style='cursor: not-allowed' disabled name='contactNoteCall' value='call'>";
                    }else{
                        echo "<input id='callNote' type='checkbox' name='contactNoteCall' value='call'>";
                    }

                ?>


	 		</div>
	 		<textarea class="contact-notes-add-content" name="contactNoteContent" placeholder="Note content"></textarea>
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <input type="hidden" name="case" value="<?php echo $case ?>">
	 		<button type="submit"><i class="fas fa-plus"></i>Add</button>
	 	</form>
	</div>
	
	<div id="contact-mails" class="contact-mails contact-tabcontent">
	 
	 <div class="contact-mail">
	 	<div class="contact-mail-box accordion">
		    <div class="contact-mail-box-icon">
		        <i class="fas fa-sign-in-alt mail-box-icon-green"></i>
		    </div>
		    <div class="contact-mail-box-title">Our meeting on Tuesday </div>
		    <div class="contact-mail-box-time">04/04/2018</div>
		
		
		</div>
		<div class="panel">
			test
		</div>
		
		
		
		<div class="contact-mail-box accordion">
		    <div class="contact-mail-box-icon">
		        <i class="fas fa-sign-out-alt mail-box-icon-red"></i>
		    </div>
		    <div class="contact-mail-box-title">Our meeting next week</div>
		    <div class="contact-mail-box-time">04/04/2018</div>
		
		</div>
		<div class="panel">
			test 2
		</div>
		
		
		
		<div class="contact-mail-box accordion">
		    <div class="contact-mail-box-icon">
		        <i class="fas fa-sign-in-alt mail-box-icon-green"></i>
		    </div>
		    <div class="contact-mail-box-title">Presentation</div>
		    <div class="contact-mail-box-time">04/04/2018</div>
		
		</div>
		<div class="panel">
			test 3
		</div>
		
			</div>
	 </div>

</div>

<!-- REmodal delete contact -->

<div class="remodal" data-remodal-id="delete">
        <form action='delete.php' method='get' class="contact-delete-contact">
        	<h3>Are you sure you want delete this?</h3>
        	<input type='hidden' name='case' value='<?php echo $case ?>'>
        	<input type='hidden' name='id' value='<?php echo $id ?>'>
                <button type='submit' class="button"><i class="fas fa-trash"></i>Delete</button>
                <button type='button' data-remodal-action="cancel" class="button"><i class="fas fa-ban"></i>Cancel</button>
        </form>
    </div>
   

<script>
    function openCity(evt, cityName, type) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("contact-tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("contact-tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" contact-active", "");
        }

        if (type === 'block'){
            document.getElementById(cityName).style.display = "block";
        }else{
            document.getElementById(cityName).style.display = "grid";
        }
        evt.currentTarget.className += " contact-active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();




var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}

// Connect Customer 

function connect(){
	var input = document.getElementById('updateCustomer').value;
	
		var xmlhttp = new XMLHttpRequest();
	        xmlhttp.onreadystatechange = function() {
	            if (this.readyState == 4 && this.status == 200) {
	            	alert(this.responseText);
	            }
	        };
	        xmlhttp.open("GET", "connectCustomer.php?customer=" + input + "&contactID=<?php echo $contact->data()->id ?>", true);
	        xmlhttp.send();
	

}



</script>

<?php
	}
?>

