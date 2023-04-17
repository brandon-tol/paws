<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Paws | Find a Pet</title>
    <link rel="icon" type="image/png" href="assets/icon.png?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="./stylesheet.css">
    <script src="./script.js"></script>
</head>
<body>
    <?php include '.template.php';?>
        <div id="content">
            <div class="wrapper">
                <h1>Find a dog or cat</h1>
                <?php
                if(isset($_POST['submit']) && isset($_POST['petType']) && isset($_POST['breeds']) && isset($_POST['gender'])) {
                    ?>
                    <h2>Results</h2>
                    <button onclick='goBack()'>Go Back</button><br>
                    <?php
                    $petType = $_POST['petType'];
                    $breeds = $_POST['breeds'];
                    $gender = $_POST['gender'];
                    $gentle = isset($_POST['gentle']) ? implode(",",$_POST['gentle']) : "";
                    $file = fopen("pet_data.txt", "r") or die("There is an error accessing the server. Please try again later.");
                    $hasResults = false;
                    while (!feof($file)) {
                        $pet_record = fgets($file);
                        $pet = explode(":", $pet_record);
                        if (preg_match("/^[^:]*:[^:]*:$petType:[^:]*$breeds"."[^:]*:[^:]*:$gender:[^:]*$gentle"."[^:]*:[^:]*:[^:]*:[^:]*$/i", rtrim($pet_record))) {
                            $hasResults = true;
                            $image = file_exists("assets/pet-directory/$pet[0].jpg") ? "assets/pet-directory/$pet[0].jpg" : "assets/pet-directory/missing-".strtolower($pet[2])."-image.png"
                            ?>
                            <div class="pet">
                                <figure>
                                    <img src="<?php echo $image; ?>" height="300px">
                                    <figcaption>
                                        Pet Type: <?php echo $pet[2];?><br>
                                        Breed: <em><?php echo $pet[3];?></em><br>
                                        Age (in human years): <em><?php echo $pet[4];?></em><br>
                                        Animal Gender: <em><?php echo $pet[5];?></em><br>
                                        This pet is gentle with: <em><?php echo trim($pet[6]) != "" ? str_replace(',',', ',$pet[6]) : "n/a";?></em><br>
                                        Other comments: <em><?php echo trim($pet[9]) != "" ? $pet[9] : "n/a";?></em><br>
                                    </figcaption>
                                </figure>
                                <button onclick="goTo(&quot;mailto:<?php echo "\&quot;$pet[7]\&quot;&lt;$pet[8]&gt;?subject=I'm%20interested%20in%20your%20pet"; ?>&quot;);">Interested?</button>
                            </div>
                            <?php
                        }
                    }
                    if(!$hasResults) {
                        echo "<p>There were no results that matched your criteria. Please try again with a new search.</p>";
                    }
                } else {
                ?>
                    <form method="post" action="#" id="findForm" onsubmit="return validateFindForm();">
                        <fieldset>
                            <legend>
                                Fill out the following form to find a potential pet
                            </legend>
                            <label><b>Which kind of pet would you like?</b></label>
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
                                <b>Please pick a breed: </b>
                                <select id="breeds" name="breeds">
                                    <option value="" id="placeholderBreeds" hidden selected disabled>Please select a pet type first</option>
                                    <option value="" id="placeholderCatBreeds" hidden disabled>Please select a cat breed:</option>
                                    <option value="" id="placeholderDogBreeds" hidden disabled>Please select a dog breed:</option>
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
                                    <option value="[^:]*" class="cat-breed dog-breed" hidden>Doesn't matter</option>
                                </select>
                            </label>
                            <br><br>
                            <label><b>Preferred Gender:</b></label><br>
                            <label for="male">
                                <input type="radio" name="gender" id="male" value="Male">
                                Male
                            </label>
                            <label for="female">
                                <input type="radio" name="gender" id="female" value="Female">
                                Female
                            </label>
                            <label for="anyGender">
                                <input type="radio" name="gender" id="anyGender" value="[^:]*">
                                Doesn't matter
                            </label>
                            <br><br>
                            <label><b>This pet should be gentle with (select any that apply):</b></label><br>
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
                        </fieldset>
                        <br>
                        <input type="submit" name="submit" value="Submit"> <input type="reset" value="Clear">
                    </form>
                <?php
                }
                ?>

            </div>
        </div>
        <script>setupForm();</script>
    </body>
</html>