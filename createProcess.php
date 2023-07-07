<!-- Style CSS -->
<link rel="stylesheet" href="assets/css/style.css">
<!-- Fonts CSS -->
<link rel="stylesheet" href="assets/css/netflix-fonts.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<body>
    <?php
    // create DOMdocment instantiation to use the xml methods
    $xml = new domdocument("1.0");

    // formatting
    $xml->formatOutput = true;
    $xml->preserveWhiteSpace = false;

    // this method simply access or manipulate the xml file 
    $xml->load("BSIT3EG1G3.xml");

    $netflixOriginals = $xml->getElementsByTagName("topNetflixOriginals");

    // get user inputs from create.php using POST and store to variable
    
    $idcode = uniqid();
    $netflixTitle = $_POST["netflixTitle"];
    $genre = $_POST["selectedGenres"];
    $hoursViewed = $_POST["hoursViewed"];
    $directedBy = $_POST["directedBy"];
    $mainCast = $_POST["mainCast"];
    $dateReleased = $_POST["dateReleased"];
    $picture = $_POST["picture"];

    // variable for identifying record
    $flag = 0;

    if ($flag == 0) {
        $topNetflixOriginals = $xml->createElement("topNetflixOriginals");
        $netflixTitle = $xml->createElement("netflixTitle", $netflixTitle);
        $pic = $xml->createElement("picture");
        $imageData = file_get_contents($picture);
        $base64 = base64_encode($imageData);
        $cdata = $xml->createCDATASection($base64);
        $pic->appendChild($cdata);

        $genre = $xml->createElement("genre", $genre);
        $hoursViewed = $xml->createElement("hoursViewed", $hoursViewed);
        $directedBy = $xml->createElement("directedBy", $directedBy);
        $mainCast = $xml->createElement("mainCast", $mainCast);
        $dateReleased = $xml->createElement("dateReleased", $dateReleased);

        // set the record an unique id using setAttribute()
        // this will be primary key
        $topNetflixOriginals->setAttribute("id", $idcode);

        // all the created elements will be added inside the <topNetflixOriginals>
        // $topNetflixOriginals->appendChild($top); 
        $topNetflixOriginals->appendChild($netflixTitle);
        $topNetflixOriginals->appendChild($pic);
        $topNetflixOriginals->appendChild($genre);
        $topNetflixOriginals->appendChild($hoursViewed);
        $topNetflixOriginals->appendChild($directedBy);
        $topNetflixOriginals->appendChild($mainCast);
        $topNetflixOriginals->appendChild($dateReleased);

        // add <topNetflixOriginals> inside the <netflixOriginals> which is the root element
        $xml->getElementsByTagName("netflixOriginals")->item(0)->appendChild($topNetflixOriginals);

        // save
        $xml->save("BSIT3EG1G3.xml");

        // success message using SweetAlert2
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>'; // include SweetAlert2 JS file
        echo '<script>';
        echo 'Swal.fire({
            title: "Success!",
            text: "Record added successfully!",
            icon: "success",
            showCancelButton: false,
            target: "body",
            confirmButtonText: "OK",
            confirmButtonColor: "red",
        }).then(() => {
            window.location.href = "manage.php"; // redirect to homepage
        });';
        echo '</script>';
    }
    ?>
</body>