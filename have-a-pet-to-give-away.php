<?php session_start();
    if(!isset($_SESSION['login_status'])) {

        setcookie('toGo','have-a-pet-to-give-away.php');
        setcookie('error_message',"You need to login before you can access the Pet Giveaway Form Page");

        header("Location: ./login.php");
    }
    if (isset($_POST['submit'])) {
        $data_file = "pet_data.txt";
        $lines = file($data_file);
        $last_line = end($lines);
        $counter = explode(':', $last_line)[0] ? explode(':', $last_line)[0] + 1 : 1;
        $username = $_SESSION['login_status'];
        $type = isset($_POST['petType']) ? $_POST['petType'] : '';
        $breeds = isset($_POST['breeds']) && !empty($_POST['breeds']) ? implode(',', $_POST['breeds']) : '';
        $age = isset($_POST['petAge']) ? $_POST['petAge'] : '';
        $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
        $temperament = isset($_POST['gentle']) ? implode(",", $_POST['gentle']) : '';
        $name = isset($_POST['ownerName']) ? $_POST['ownerName'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $comments = isset($_POST['comments']) ? preg_replace("/\r?\n|\r/", "<br>", $_POST['comments']) : '';
        if(isset($_FILES["photo"])) move_uploaded_file($_FILES["photo"]["tmp_name"], "assets/pet-directory/$counter.jpg");
        $data = "$counter:$username:$type:$breeds:$age:$gender:$temperament:$name:$email:$comments\n";
        $file = fopen($data_file, "a") or die("Unable to open file!");
        fwrite($file, $data);
        fclose($file);
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Paws | Have a pet to give away</title>
        <link rel="icon" type="image/png" href="assets/icon.png?v=<?php echo time(); ?>">
        <link rel="stylesheet" type="text/css" href="./stylesheet.css">
        <script src="./script.js"></script>
    </head>
    <?php
    include '.template.php';
    ?>
    <body>
        <div id="content">
            <div class="wrapper scrollable">
                <h1>Have a pet to give away?</h1>
                <form method="post" action="" id="giveawayForm" enctype="multipart/form-data" onsubmit="return validateGiveawayForm();">
                    <fieldset>
                        <legend>
                            Pet Details
                        </legend>
                        <label><b>Which kind of pet do you have?</b></label>
                        <br>
                        <label for="dog">
                            <input type="radio" name="petType" id="dog" value="Dog">
                            Dog
                        </label>
                        <label for="cat">
                            <input type="radio" name="petType" id="cat" value="Cat">
                            Cat
                        </label>
                        <br><br>
                        <label>
                            <b>Please pick a breed (hold down the CTRL key on Windows or the Command key on macOS to mix breeds):</b><br>
                            <select id="breeds" name="breeds[]" multiple size="6">
                                <option id="placeholderBreeds" disabled>Please select a pet type first</option>
                                <option value="Labrador" class="dog-breed" hidden>Labrador</option>
                                <option value="Golden Retriever" class="dog-breed" hidden>Golden Retriever</option>
                                <option value="Rottweiler" class="dog-breed" hidden>Rottweiler</option>
                                <option value="Bulldog" class="dog-breed" hidden>Bulldog</option>
                                <option value="Poodle" class="dog-breed" hidden>Poodle</option>
                                <option value="Siamese" class="cat-breed" hidden>Siamese</option>
                                <option value="Persian" class="cat-breed" hidden>Persian</option>
                                <option value="Ragdoll" class="cat-breed" hidden>Ragdoll</option>
                                <option value="Bengal" class="cat-breed" hidden>Bengal</option>
                                <option value="Bombay" class="cat-breed" hidden>Bombay</option>
                                <option value="Unknown Breed" class="cat-breed dog-breed" hidden>Other</option>
                            </select>
                        </label><br><br>
                        <label for="petAge">
                            <b>Age (in human years):</b> 
                            <input type="number" id="petAge" name="petAge" placeholder="">
                        </label>
                        <br><br>
                        <label><b>Animal Gender:</b></label>
                        <label for="male">
                            <input type="radio" name="gender" id="male" value="Male">
                            Male
                        </label>
                        <label for="female">
                            <input type="radio" name="gender" id="female" value="Female">
                            Female
                        </label>
                        <br><br>
                        <label><b>This pet is gentle with (select any that apply):</b></label><br>
                        <label for="goodWithChildren">
                            <input type="checkbox" id="goodWithChildren" name="gentle[]" value="Children">
                            Children
                        </label>
                        <label for="goodWithOtherDogs">
                            <input type="checkbox" id="goodWithOtherDogs" name="gentle[]" value="Other dogs">
                            Other dogs
                        </label>
                        <label for="goodWithOtherCats">
                            <input type="checkbox" id="goodWithOtherCats" name="gentle[]" value="Other cats">
                            Other cats
                        </label>
                        <br><br>
                        <label for="otherComments"><b>Other Comments: </b><br>
                            <textarea id="otherComments" name="comments" placeholder="Enter any additional details here." form="giveawayForm"></textarea>
                        </label><br><br>
                        <label for="photo">
                            <b>Choose a photo to upload:</b><br>
                            <input type="file" id="photo" name="photo">
                        </label>
                    </fieldset>
                    <fieldset>
                        <legend>
                            Current Owner Information
                        </legend>
                        <label for="owner-name">
                            Name:
                            <input id="owner-name" name="ownerName" type="text">
                        </label>
                        <br>
                        <label for="email">
                            Email: 
                            <input id="email" name="email" type="email">
                        </label>
                    </fieldset>
                    <br>
                    <input type="submit" name='submit' value="Submit"> <input type="reset" value="Clear">
                </form>
            </div>
        </div>
        <script>setupForm();</script>
    </body>
</html>