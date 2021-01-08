<?php
require_once "credentials.php";
///////////////////////////////////////////////////////////CONNECTION///////////////////////////////////////////////////
$connection = mysqli_connect($dbhost, $dbuser, $dbpass);

if (!$connection)
{
    if (isset($mysqli_connect_error)) {
        die("Connection failed: " . $mysqli_connect_error);
    }
}
/////////////////////////////////////////////////////////DATABASE CREATION//////////////////////////////////////////////
$sql = "CREATE DATABASE IF NOT EXISTS " . $dbname;

//condition to account for success/failure of database creation
if (mysqli_query($connection, $sql))
{
    echo "Database created successfully, or already exists <br>";
}
else
{
    die("Error creating database: " . mysqli_error($connection));
}

mysqli_select_db($connection, $dbname);

/////////////////////////////////////////////
/////////////// DROP TABLES /////////////
/////////////////////////////////////////////

$sql = "DROP TABLE IF EXISTS images";

if (mysqli_query($connection, $sql))
{
    echo "Dropped existing table: images<br>";
}
else
{
    die("Error checking for existing images table: " . mysqli_error($connection));
}


$sql = "DROP TABLE IF EXISTS slider";

if (mysqli_query($connection, $sql))
{
    echo "Dropped existing table: slider<br>";
}
else
{
    die("Error checking for existing slider table: " . mysqli_error($connection));
}


$sql = "DROP TABLE IF EXISTS products_orders";

if (mysqli_query($connection, $sql))
{
    echo "Dropped existing table: products_orders<br>";
}
else
{
    die("Error checking for existing products_orders table: " . mysqli_error($connection));
}


$sql = "DROP TABLE IF EXISTS orders";

if (mysqli_query($connection, $sql))
{
    echo "Dropped existing table: orders<br>";
}
else
{
    die("Error checking for existing orders table: " . mysqli_error($connection));
}

$sql = "DROP TABLE IF EXISTS products_category";

if (mysqli_query($connection, $sql))
{
    echo "Dropped existing table: products_category<br>";
}
else
{
    die("Error checking for existing products_category table: " . mysqli_error($connection));
}


$sql = "DROP TABLE IF EXISTS products";

if (mysqli_query($connection, $sql))
{
    echo "Dropped existing table: products<br>";
}

else
{
    die("Error checking for existing products table: " . mysqli_error($connection));
}


$sql = "DROP TABLE IF EXISTS category";

if (mysqli_query($connection, $sql))
{
    echo "Dropped existing table: category<br>";
}
else
{
    die("Error checking for existing category table: " . mysqli_error($connection));
}


$sql = "DROP TABLE IF EXISTS users";

if (mysqli_query($connection, $sql))
{
    echo "Dropped existing table: users<br>";
}
else
{
    die("Error checking for existing users table: " . mysqli_error($connection));
}



$sql = "DROP TABLE IF EXISTS customer";

if (mysqli_query($connection, $sql))
{
    echo "Dropped existing table: customer<br>";
}
else
{
    die("Error checking for existing customer table: " . mysqli_error($connection));
}


$sql = "DROP TABLE IF EXISTS address";

if (mysqli_query($connection, $sql))
{
    echo "Dropped existing table: address<br>";
}
else
{
    die("Error checking for existing address table: " . mysqli_error($connection));
}



/////////////////////////////////////////////
/////////////// CREATE TABLES /////////////
/////////////////////////////////////////////

$sql = "CREATE TABLE address (addr_id INT(5) AUTO_INCREMENT, addr_ln1 VARCHAR(100),addr_ln2 VARCHAR(100),addr_city VARCHAR(100),addr_country VARCHAR(100), addr_postcode VARCHAR(9) NOT NULL, PRIMARY KEY (addr_id));";
if (mysqli_query($connection, $sql))
{
    echo "Table created successfully: address<br>";
}
else
{
    die("Error creating address table: " . mysqli_error($connection));
}


$sql = "CREATE TABLE customer (cust_id INT(5) AUTO_INCREMENT, firstName VARCHAR(100), lastName VARCHAR(100), tele_no VARCHAR (16), addr_id INT(5), email VARCHAR(350) NOT NULL UNIQUE , dob DATE, PRIMARY KEY (cust_id), FOREIGN KEY (addr_id) REFERENCES address(addr_id) ON DELETE CASCADE);";

if (mysqli_query($connection, $sql))
{
    echo "Table created successfully: customer<br>";
}

else
{
    die("Error creating address table: customer" . mysqli_error($connection));
}


$sql = "CREATE TABLE users (cust_id INT(5), username VARCHAR(100), password VARCHAR(100), verified tinyint(1) NOT NULL DEFAULT 0,  verification_key varchar(255) DEFAULT NULL, FOREIGN KEY (cust_id) REFERENCES customer(cust_id)ON DELETE CASCADE);";
if (mysqli_query($connection, $sql))
{
    echo "Table created successfully: users<br>";
}
else
{
    die("Error creating address table: customer" . mysqli_error($connection));
}


$sql = "CREATE TABLE category (cat_id INT(4) AUTO_INCREMENT, cat_title VARCHAR(100) NOT NULL, sub_cat varchar(100), sub_sub_cat varchar(100), PRIMARY KEY (cat_id));";
if (mysqli_query($connection, $sql))
{
    echo "Table created successfully: category<br>";
}

else
{
    die("Error creating address table: category" . mysqli_error($connection));
}


$sql = "CREATE TABLE products (prod_id INT(10) AUTO_INCREMENT, cat_id INT(4), prod_title VARCHAR(300), prod_dscr VARCHAR (1000), price DECIMAL (6,2), prod_qty int(4), PRIMARY KEY (prod_id), FOREIGN KEY(cat_id) REFERENCES category(cat_id) ON DELETE CASCADE);";

if (mysqli_query($connection, $sql))
{
    echo "Table created successfully: products<br>";
}
else
{
    die("Error creating address table: products" . mysqli_error($connection));
}

$sql = "CREATE TABLE products_category (prod_id INT(10), cat_id INT(4),PRIMARY KEY (prod_id, cat_id), FOREIGN KEY(prod_id) REFERENCES products(prod_id) ON DELETE CASCADE, FOREIGN KEY(cat_id) REFERENCES category(cat_id) ON DELETE CASCADE );";
if (mysqli_query($connection, $sql))
{
    echo "Table created successfully: products<br>";
}
else
{
    die("Error creating address table: products" . mysqli_error($connection));
}

$sql = "CREATE TABLE orders (order_id INT(10) AUTO_INCREMENT, cust_id INT(5), total DECIMAL (10,2), PRIMARY KEY (order_id), FOREIGN KEY(cust_id) REFERENCES customer(cust_id) ON DELETE CASCADE);";
if (mysqli_query($connection, $sql))
{
    echo "Table created successfully: orders<br>";
}
else
{
    die("Error creating address table: orders" . mysqli_error($connection));
}

$sql = "CREATE TABLE products_orders (order_id INT(10), prod_id INT(10), prod_quantity INT(10), product_line_cost DECIMAL (10,2), FOREIGN KEY(prod_id) REFERENCES products(prod_id) ON DELETE CASCADE, FOREIGN KEY(order_id) REFERENCES orders(order_id) ON DELETE CASCADE);";
if (mysqli_query($connection, $sql))
{
    echo "Table created successfully: products_orders<br>";
}
else
{
    die("Error creating address table: products_orders" . mysqli_error($connection));
}

$sql = "CREATE TABLE slider (slider_id INT(4) AUTO_INCREMENT, slider_img VARCHAR (100), prod_id INT(10), PRIMARY KEY (slider_id), FOREIGN KEY(prod_id) REFERENCES products(prod_id) ON DELETE CASCADE);";
if (mysqli_query($connection, $sql))
{
    echo "Table created successfully: products_orders<br>";
}
else
{
    die("Error creating address table: products_orders" . mysqli_error($connection));
}

$sql = "CREATE TABLE images (img_id int(11) NOT NULL AUTO_INCREMENT, file_name VARCHAR (255) COLLATE utf8_unicode_ci NOT NULL, uploaded_on DATE , prod_id INT(10), PRIMARY KEY (img_id), FOREIGN KEY(prod_id) REFERENCES products(prod_id) ON DELETE CASCADE);";
if (mysqli_query($connection, $sql))
{
    echo "Table created successfully: images<br>";
}
else
{
    die("Error creating address table: images" . mysqli_error($connection));
}


/////////////////////////////////////////////////////////INSERT TABLE DATA//////////////////////////////////////////////

/////////////////////////////////////////////
/////////////// POPULATE TABLES /////////////
/////////////////////////////////////////////

$addr_ln1[] = '79  Carriers Road'; $addr_ln2[] = 'Jesmond Lane'; $addr_city[] = 'Creekmouth';  $addr_country[] = 'United Kingdom'; $addr_postcode[] = 'IG11 2GY';
$addr_ln1[] = '82  St James'; $addr_ln2[] = 'Boulevard'; $addr_city[] = 'Houghton Bank';  $addr_country[] = 'United Kingdom'; $addr_postcode[] = 'DL2 4PW';
$addr_ln1[] = '40  Main Road'; $addr_ln2[] = 'Churchill Park'; $addr_city[] = 'Aunchree';  $addr_country[] = 'United Kingdom'; $addr_postcode[] = 'DD8 1RB';
$addr_ln1[] = '75  High Street'; $addr_ln2[] = 'walmersley lane'; $addr_city[] = 'Manchester';  $addr_country[] = 'United Kingdom'; $addr_postcode[] = 'BL9 1CD';
$addr_ln1[] = '32 Shirley Rd'; $addr_ln2[] = 'Cheetham Hill'; $addr_city[] = 'Greater Manchester';  $addr_country[] = 'United Kingdom'; $addr_postcode[] = 'M8 9HL';
$addr_ln1[] = 'MMU'; $addr_ln2[] = 'All Saints Library'; $addr_city[] = 'Manchester';  $addr_country[] = 'United Kingdom'; $addr_postcode[] = 'M14 0BD';

for ($i=0; $i<count($addr_postcode); $i++)
{
    $sql = "INSERT INTO address (addr_ln1, addr_ln2, addr_city, addr_country, addr_postcode) VALUES ('$addr_ln1[$i]', '$addr_ln2[$i]', '$addr_city[$i]', '$addr_country[$i]', '$addr_postcode[$i]');";

    if (mysqli_query($connection, $sql))
    {
        echo "Table Name: address - row inserted<br>";
    }
    else
    {
        die("Error inserting rows for address: " . mysqli_error($connection));
    }
}

$f_name[] = 'Amelie'; $l_name[] = 'Begum'; $tele_no[] = '070 3598 9489'; $addr_id[] = '1'; $email[] = 'lk81easq8p@groupbuff.com'; $dob[] = '1982/02/25';
$f_name[] = 'Louie'; $l_name[] = 'Moss'; $tele_no[] = '077 7025 5915'; $addr_id[] = '2'; $email[] = 'w3ee25n68ed@classesmail.com'; $dob[] = '2000/10/12';
$f_name[] = 'Amelia'; $l_name[] = 'Sullivan'; $tele_no[] = '079 8746 6358'; $addr_id[] = '3'; $email[] = '8bxvrridlxb@meantinc.com'; $dob[] = '1989/01/05';
$f_name[] = 'Sophia'; $l_name[] = 'Middleton'; $tele_no[] = '077 3840 7644'; $addr_id[] = '4'; $email[] = '9ox76bve6n5@classesmail.com'; $dob[] = '1999/04/24';
$f_name[] = 'Charlie'; $l_name[] = 'Duffy'; $tele_no[] = '078 2448 4837'; $addr_id[] = '5'; $email[] = '1kaf0no3qx8@groupbuff.com'; $dob[] = '1999/06/11';
$f_name[] = 'Abdullah'; $l_name[] = 'Zafar'; $tele_no[] = '07380288823'; $addr_id[] = '6'; $email[] = 'azafuni1999@gmail.com'; $dob[] = '1999/07/26';

for ($i=0; $i<count($f_name); $i++)
{
    $sql = "INSERT INTO customer (firstName, lastName, tele_no, addr_id, email, dob) VALUES ('$f_name[$i]', '$l_name[$i]', '$tele_no[$i]', '$addr_id[$i]', '$email[$i]', '$dob[$i]');";

    if (mysqli_query($connection, $sql))
    {
        echo "Table Name: customer - row inserted<br>";
    }
    else
    {
        die("Error inserting rows for customer: " . mysqli_error($connection));
    }
}

$ver_key = bin2hex(random_bytes(50)); // generate unique token

$cust_id[] = '1'; $username[] = 'user1'; $password[] = 'user1'; $verified[] = '1'; $verification_key[] = $ver_key;
$cust_id[] = '2'; $username[] = 'user2'; $password[] = 'user2'; $verified[] = '1'; $verification_key[] = $ver_key;
$cust_id[] = '3'; $username[] = 'user3'; $password[] = 'user3'; $verified[] = '1'; $verification_key[] = $ver_key;
$cust_id[] = '4'; $username[] = 'user4'; $password[] = 'user4'; $verified[] = '1'; $verification_key[] = $ver_key;
$cust_id[] = '5'; $username[] = 'user5'; $password[] = 'user5'; $verified[] = '1'; $verification_key[] = $ver_key;
$cust_id[] = '6'; $username[] = 'admin'; $password[] = 'admin'; $verified[] = '1'; $verification_key[] = $ver_key;

for ($i=0; $i<count($username); $i++)
{
    $options = array("cost"=>4);
    $hashedPassword = password_hash($password[$i],PASSWORD_BCRYPT,$options);
    $sql = "INSERT INTO users (cust_id, username, password, verified, verification_key) VALUES ('$cust_id[$i]', '$username[$i]', '$hashedPassword', '$verified[$i]', '$verification_key[$i]');";

    if (mysqli_query($connection, $sql))
    {
        echo "Table Name: users - row inserted<br>";
    }
    else
    {
        die("Error inserting rows for users: " . mysqli_error($connection));
    }
}
//products would be mens clothing womens clothing
$cat_title[] = 'All Categories'; $sub_cat[] = '-'; ; $sub_sub_cat[] = '-';
$cat_title[] = 'Health and Beauty'; $sub_cat[] = 'Skin Care'; $sub_sub_cat[] = 'Facial Products';
$cat_title[] = 'Home Décor'; $sub_cat[] = 'Art'; $sub_sub_cat[] = 'Prints';
$cat_title[] = 'Health and Fitness'; $sub_cat[] = 'Clothing'; $sub_sub_cat[] = 'Shoes';
$cat_title[] = 'Sporting Goods'; $sub_cat[] = 'Cycling'; $sub_sub_cat[] = 'Bikes';
$cat_title[] = 'Supplements'; $sub_cat[] = 'Dietary Supplements'; $sub_sub_cat[] = 'Powder';
$cat_title[] = 'Technology'; $sub_cat[] = 'Mobile Phones'; $sub_sub_cat[] = 'Samsung';
$cat_title[] = 'Camping and Hiking'; $sub_cat[] = 'Camping Tents and Canopies'; $sub_sub_cat[] = 'Tents';

for ($i=0; $i<count($cat_title); $i++)
{
    $sql = "INSERT INTO category (cat_title, sub_cat, sub_sub_cat) VALUES ('$cat_title[$i]', '$sub_cat[$i]' , '$sub_sub_cat[$i]');";

    if (mysqli_query($connection, $sql))
    {
        echo "Table Name: category - row inserted<br>";
    }
    else
    {
        die("Error inserting rows for category: " . mysqli_error($connection));
    }
}



////////////////////prods for cat 2

$cat_id[] = '2'; $prod_title[] = 'LOreal Paris Men Expert, Beard Shampoo'; $prod_dscr[] = '3 in 1 wash for beard, face and hair. Enriched with cedar wood essential oil .Free from soap, parabens, colourants and ingredients from animal origin. Men Expert Support The Movember Foundation, A Registered Charity, And Commit To Contribute A Total Of £1.3M To The Charity 2017 - 2020. Charity Number 1137948. Men Expert Support The Movember Foundation, A Registered Charity, And Commit To Contribute A Total Of £1.3M To The Charity 2017 - 2020. Charity Number 1137948.'; $price[] = '11.58'; $prod_qty[] = '15';
$cat_id[] = '2'; $prod_title[] = 'Facial Cleansing Brush MYCARBON IPX5'; $prod_dscr[] = '★Comfortable★ The bristles processed with innovative micro technology will make much more soft,avoid scraping and injury to the skin. Use the sponges to gently remove makeup or facial surface oils. ★4 IN ONE★ 4 different facial cleansing brushes are used for cleaning, peeling, exfoliating and massaging. There are two different brushes for both sensitive skin and normal skin. 2 Speed Settings. 2 AA Batteries Included ★Waterproof★ IPX5 waterproof ensure the safety when using in bathroom or shower.Tips: Cleaning and drying after use, please place the brush in the stand so that it will quickly dry, in order to prevent moisture buildup. ★Massage★ The rolling massager head will improve blood circulation. Tips: Sensitive skin suggest to use the slow speed. ★Convenient★ You can use it with any facial cleanser or essential oils. Enjoy Spa-quality facial care at home or when traveling. Only 15cm long and light-weight, all will be assembled in a small box.★★★Perfect Christmas gifts for your family or friends. ★★★'; $price[] = '15.99'; $prod_qty[] = '24';
$cat_id[] = '2'; $prod_title[] = 'Aloe Vera Juice Max Strength - 1litre'; $prod_dscr[] = 'Derived from a unique blend of aloe vera whole leaf and unfiltered aloe vera inner gel 100 percent natural aloe vera juice May help to cleanse, rejuvenate and maintain a healthy digestive system No artificial sweeteners, flavours or colours Suitable for vegetarians and vegans A unique blend of Aloe Vera unfiltered virgin inner gel fillet and filtered whole leaf, formulated with the minimum of processing to allow the plants natural components to remain unaltered and provide high levels of natural activity, as is expected in a quality aloe Vera juice. Available in 1 litre bottle.'; $price[] = '7.98'; $prod_qty[] = '54';
$cat_id[] = '2'; $prod_title[] = 'PREMIUM Natural Charcoal Mask'; $prod_dscr[] = 'GET RID OF ALL YOUR BLACKHEADS: Clogged pores create blackheads on your nose, cheeks, chin and T zone, but, don’t worry, you can easily get rid of them! The Activated Charcoal Bamboo Mask will remove all of your blackheads with one easy move. This innovative Face Mask is the secret to a clearer face. HAVE A FLAWLESS, SMOOTH SKIN: The Charcoal Black Mask will remove all of your blackheads. The deep cleansing of the Galact Facial Mask will leave your skin smoother and cleaner. Your pores will minimize and, with regular use, you will gradually have flawless skin! Try it out and see for yourself!'; $price[] = '8.99'; $prod_qty[] = '29';
$cat_id[] = '2'; $prod_title[] = 'Scholl Velvet Smooth Pedi Electric Foot File Hard Skin Remover, Pink'; $prod_dscr[] = 'Get soft elegant feet effortlessly. The Scholl velvet smooth express pedi electric foot file with long lasting micro-abrasive particles and finely ground diamond crystals buffs away hard skin in an instant, leaving you with smooth feet.Electric foot file to buff away hard skin in minutes for healthy-looking feetIdeal for the safe and professional removal of hard skin from your feet at home Ergonomically-designed soft touch handle Electric foot file replaceable roller head Roller head extra coarse'; $price[] = '15.28'; $prod_qty[] = '74';





////////////////////prods for cat 3
$cat_id[] = '3'; $prod_title[] = 'General World Map Black Background Wall Art Painting Pictures Print On Canvas Art'; $prod_dscr[] = 'Size:12x26Inchx2Panel,12x35Inchx2Panel Feature:More than 28000 kinds of wall art to Meet your needs in my shop Giclee artwork, print on the premium artist canvas.Gallery wrapped and stretched with wooden frame on the back. Each panel has a black hook already mounted on the wooden bar ready to hang out of box. A perfect wall decorations paintings for living room, bedroom, kitchen, office, Hotel, dining room, office, bathroom, bar etc..A great gift idea for your relatives and friends. Your satisfaction is 100% guaranteed! Once your prints arrives, if you are unhappy for any reason, we will provide a full refund within 30 days after receipt.'; $price[] = '42.58'; $prod_qty[] = '17';
$cat_id[] = '3'; $prod_title[] = 'Window Curtain String Lights,300 LED Icicle Fairy Twinkle Starry Lights'; $prod_dscr[] = 'Widely Used: The window icicle lights is IP44, so it can be anti-cold , waterproof and against frost!it will work properly even though in cold winter. Ideal for indoor and outdoor decoration,it can be hung on walls, windows, doors, floors, ceilings, grasse, Christmas trees, etc. 8 Light Modes: combination, in waves, sequential, slogs , chasing/flash, slow fade, twinkle/flash, and steady on. With just one button for modes switch Higher Safety: BS certificated waterproof plug, safe low voltage (36v) and misplug-proof connectors hugely increased the security. High brightness LED is energy efficient, cost saving, environmental protection and long lifespan.'; $price[] = '13.99'; $prod_qty[] = '20';
$cat_id[] = '3'; $prod_title[] = 'Ceramic Smoke Waterfall Backflow Incense Burner Handmade Cone'; $prod_dscr[] = '❤ SUITABLE SIZE: 16.5 x 8 x 21cm/6.5x 3.1x 8.3 (L x W x H) | Suitable for home, office, teahouse, meditation, yoga etc. ❤ HANDMADE: Each of our products is made by the folk craftsmen handmade, workmanship is very delicate! The perfect handicraft! Very suitable for collection! ❤ AT HOME: Lit a incense , warm and comfortable. A good smell of incense before the guests visit, is not only a courtesy, respect for the guests , but also reflects the host elegant taste. IN OFFICE: Lit a incense, clean air, refreshing, maintaining a pleasant body and mind, improving work efficiency. READING TIME: Lit a incense, while reading a book, while tea, can completely relax, improve quality of life.'; $price[] = '22.88'; $prod_qty[] = '125';
$cat_id[] = '3'; $prod_title[] = '15 Pieces Removable Acrylic Mirror Setting Wall Sticker Decal'; $prod_dscr[] = 'Material: these hexagons mirror wall sticker decal is made of plastic, the surface is reflective and the back has glue itself; The surface has a protective film on it, in order to get better feeling and clear mirrors, please just take it out when you use it Size type: hexagons shape, each size is approx. 16 x 18.4 x 9.2 cm Function: decorative mirror design makes your home looks different, more attractive; For the reflective surface can make your room brighter Applicable place: it could be applied to any smooth and clean surfaces such as walls, doors, windows, closet, and so on, suit for living room, childrens playroom, dining room, kitchen, gymnasiums, home office, hallway, porch and many more'; $price[] = '13.58'; $prod_qty[] = '15';
$cat_id[] = '3'; $prod_title[] = 'GUOCHENG HOME Alphabet Decorative LED Mood Lights'; $prod_dscr[] = '☆ Batteries operated romantic LED night light, put it on your bedside bookshelf, dresser or coffee table. Good everyday indoor decor. ☆ Power: Required 3AA batteries (not include), on/off switch on the back, steady on mode. ☆ Size: 29.5cm x 12cm x 5.5cm/11.61inch x 4.72inch x 2.17inch.(Approx) ☆ This warm white mood light is the ideal eye catching decoration for your bedroom drawing room etc. ☆ Nice christmas birthday wedding gift for kids children girls women friends and loved one.'; $price[] = '10.98'; $prod_qty[] = '15';




////////////////////prods for cat 4
$cat_id[] = '4'; $prod_title[] = 'Nike Air Max 200';
$prod_dscr[] = ' With exceptional cushioning and modern detailing, the Nike Air Max 200 radiates cool while providing extreme comfort. Its design is inspired by patterns of energy radiating from the earth—like the flow of lava and the oceans rhythmic waves.
Colour Shown: Black/Deep Royal Blue/University Gold
Style: AQ2568-004';
$price[] = '76.47'; $prod_qty[] = '8';

$cat_id[] = '4'; $prod_title[] = 'Jordan "Chinese New Year"'; $prod_dscr[] = 'Put a celebratory spin on a favourite sport silhouette in the Jordan "Chinese New Year" Sweatshirt. Made from heavyweight, stretch-knit fleece, this roomy, relaxed hoodie features a standout chenille Jumpman design on the chest and all-new graphics that honour the Chinese celebration.'; $price[] = '8999.99'; $prod_qty[] = '10';
$cat_id[] = '4'; $prod_title[] = 'Nike Mens T-lite Xi Sports Shoes'; $prod_dscr[] = 'NIKE - T LITE XI - 0887229108454 Athletic & Outdoor Shoes - Mens Outer Material: Other Leather Inner Material: Textile Sole: Synthetic Closure: Lace-Up Heel Type: Flat Material Composition: Composite Shoe Width: Normal Size: 8 - (White / Black)'; $price[] = '35.99'; $prod_qty[] = '10';
$cat_id[] = '4'; $prod_title[] = 'AIR MAX 90 Mens Womens Red Sports Trainers Classic Sneaker Running Shoes'; $prod_dscr[] = 'Condition: Brand New with Box Color : As shown Sizes Available: UK 3, UK 4, UK 4.5, UK 5.5, UK 6, UK 7, UK 7.5, UK 8.5, UK 9 Suitable for road trail running, party, sports, indoor, outdoor,work out walking; shop, jogging,travel, gym, joggers, running, every day walk-around, home, regular day walking, any occasion, casual and trend. adults size for couples and lovers.'; $price[] = '68.99'; $prod_qty[] = '10';
$cat_id[] = '4'; $prod_title[] = 'Nike Air Span ll New Mens Casual Running Trainers shoes'; $prod_dscr[] = 'After a span of nearly three decades, the Nike Air Span II SE returns with everything you loved about the original. Its upper is nearly indistinguishable from that of the 1989 shoe, as are its iconic lines and branding, while modern comfort innovations in the midsole and outsole usher this shoe into a new era.'; $price[] = '89.99'; $prod_qty[] = '10';








////////////////////prods for cat 5
$cat_id[] = '5'; $prod_title[] = 'Snugpak Ionosphere Bivy Tent 1 Person'; $prod_dscr[] = 'Flysheet: Lightweight 210t Polyester RipStop with a 5000-mm waterproof PU coating Inner tent constructed of 190t Nylon with Polyester Mesh 50D Polyester No-See-Um-Mesh DAC Featherlite NSL anodized poles with press-fit connectors All DAC poles are made from TH72M aluminium 1 door All seams are taped sealed Alloy stakes (14 + 2 spares) Available in Olive outer with Black inner only Trail weight (Fly, Poles & Inner Tent): 2.64 lb (1.2 kg) Pack weight (Fly, Poles, Inner Tent, Stakes, Guy Ropes & Stuff Sack): 3.34 lb (1.52 kg)'; $price[] = '118.58'; $prod_qty[] = '4';
$cat_id[] = '5'; $prod_title[] = 'Vitus Vitesse Evo CRS Disc Road Bike (Ultegra) 2019 Black - Red XL 700c'; $prod_dscr[] = 'The all NEW Vitesse EVO has been redesigned from the ground up to deliver performance; comfort and full compatibility with mechanical and electronic groupsets. This UCI approved frameset has been raced throughout the 2015 season by the An Post Chain Reaction team in some of the most gruelling European roads including the cobbled sections of Paris/Roubaix; race tested; race proven; race ready!
The Vitesse EVO Team is our An Post – Chain Reaction Team replica model featuring components that have been tried and tested by the UCI Continental team. Dura Ace 9000 11-speed gearing; FSA SLK Light components matched with Fulcrum Racing 3 wheels complete this amazing race build.'; $price[] = '2999.99'; $prod_qty[] = '4';

$cat_id[] = '5'; $prod_title[] = 'EUROBIKE Mountain bike TSM G7 bicycle 27.5Inch Dual Disc Brake Folding Bike'; $prod_dscr[] = 'Disc Brake System - Provides long lasting and stronger fasting stopping power than the traditional V-Brake Systems. Fashion design and 27.5 inches Aluminum rims. Disc Brake System - Provides long lasting and stronger fasting stopping power than the traditional V-Brake Systems. Recommended for rider s height 5 5"-6 0". Max weight up to 310lbs'; $price[] = '218.58'; $prod_qty[] = '14';
$cat_id[] = '5'; $prod_title[] = 'Eurobike Mountain Bike X9 Bicycles 29" 21Speed Dual Disc Brake Spoke Wheels Bike'; $prod_dscr[] = 'Disc Brake System - Provides long lasting and stronger fasting stopping power than the traditional V-Brake Systems. Dual suspension mountain bike makes your cycling more perfect. 29 inches Spoke wheels more fashion and easy to control. With a lifetime manufacturers warranty on frames and a one-year manufacturers warranty on components, you can ride confidently with the knowledge that weve got you covered. (To activate your warranty, professional assembly is required).'; $price[] = '318.58'; $prod_qty[] = '43';
$cat_id[] = '5'; $prod_title[] = 'Flying Mountain Bikes Bicycles 21 speeds Shimano Lightweight Aluminium Alloy Frame Disc Brake'; $prod_dscr[] = 'Strong lightweight aluminium alloy frame, frame size 17″ (46cm) = M, suitable for height 1,65 m – 1,80 m 21-speed gears with shimano EF500 Brake/Shift handlebar-mounted control levers, Freewheel Shimano MF-TZ500-7 14T-28T, Front Derailleur Shimano FD-TZ50, Rear Derailleur Shimano RD-TY50. KMC chain. Prowheel crank. Alloy disc brake, double wall alloy wider rim, quick release for the front wheels, 26″ x 1.95″,A/V good look tyre with extra puncture protection. Front suspension fork with lock, 80mm travel. Non-slip with grips pedals. Front and rear mudguard included, with kickstand. The inner tube is standard 26 * 1.95 with 60mm Schrader valve.'; $price[] = '418.58'; $prod_qty[] = '44';





////////////////////prods for cat 6
$cat_id[] = '6'; $prod_title[] = 'Cod Liver Oil High Strength 1000mg 365 Capsules UK Made NaturPlus'; $prod_dscr[] = 'Cod Liver Oil 1000mg High Strength Softgel Capsules.
Cod liver oil is a natural source of vitamins A and D, and high strength formulations also provide significant levels of essential fatty acids EPA and DHA.
Manufactured in the UK
Our products are manufactured in the UK to the high standards as required by Trading Standards, UK Legislation and the Food Standards Agency.'; $price[] = '9.49'; $prod_qty[] = '1';

$cat_id[] = '6'; $prod_title[] = 'ANNURCA Plus Hair | 60 Capsules | Food Supplement'; $prod_dscr[] = 'Our HAIR has now a more ally and is called ANNURCA plus hair H|B!!! It restores life to the hair and protects it from oxidative stress and cellular aging. It makes the hair healthier, more alive, stronger, thicker and less prone to deterioration, hair loss or hair breakage. It favors an increase in hair and increases by about a third the weight and their keratin content is able to ensure beneficial effects on the beauty and health of the hair, increasing its growth in a completely effective and natural way.'; $price[] = '28.58'; $prod_qty[] = '44';
$cat_id[] = '6'; $prod_title[] = 'Organic Turmeric Curcumin 1380mg with Organic Black Pepper & Organic Ginger'; $prod_dscr[] = 'HIGH POTENCY & PREMIUM QUALITY INGREDIENTS: Not only is our Turmeric Curcumin Supplement of the highest quality, all of our ingredients are Certified Organic with each dose containing 1260mg of Turmeric Curcumin. We never use any binders or fillers. FORMULATED FOR MAXIMUM ABSORPTION & BIOAVAILABILITY: Our incredible Turmeric Capsules include Organic Ginger and Organic Black Pepper (Piperine). The Black Pepper plays a key role in increasing the absorption of Curcumin and other Curcuminoid nutrients found in Turmeric.'; $price[] = '29.58'; $prod_qty[] = '44';
$cat_id[] = '6'; $prod_title[] = 'Optimum Nutrition Gold Standard Pre Workout Energy Drink Powder'; $prod_dscr[] = 'An ‘Informed Choice – Banned Substance Tested’ ready-to-mix pre-workout powder catering to strength athletes, team sports athletes, endurance athletes, gym goers, and multi-faceted athletes Naturally-sourced caffeine plus L-Carnitine and N-Acetyl-Tyrosine helps sharpen your alertness and focus while helping your body train at the highest level Creatine Monohydrate (CreaPure) helps to support overall power and performance Citrulline Malate, a precursor to nitric oxide production Vitamins B1, B3, B5, B6, B12 help your metabolism operate at its peak'; $price[] = '18.58'; $prod_qty[] = '24';
$cat_id[] = '6'; $prod_title[] = 'Omega 3 Fish Oil 1000mg 365 Softgels 1 Year Supply'; $prod_dscr[] = 'MAXIMUM POTENCY - 1,000mg Omega 3 Fish Oil capsule, premium formulation with Omega 3 6 9, contaminant free with potent levels of balanced EPA and DHA CONVENIENT SOURCE OF OMEGA 3 - Many of us do not eat enough nutritious oily fish, our Omega 3 Softgels give a convenience source of high quality Omega 3 in a source that is highly absorbent.  UP TO 12 MONTHS FULL SUPPLY - Our incredible 365 Fish Oil capsules pack gives amazing VALUE keeping you replenished with high strength Omega 3 Fish Oil Capsules for up to 12 months. No need to remember to reorder every month with 52 week supply.'; $price[] = '16.58'; $prod_qty[] = '44';






for ($i=0; $i<count($prod_title); $i++)
{
    $sql = "INSERT INTO products (cat_id, prod_title, prod_dscr, price, prod_qty) VALUES ('$cat_id[$i]', '$prod_title[$i]', '$prod_dscr[$i]', '$price[$i]', '$prod_qty[$i]');";

    if (mysqli_query($connection, $sql))
    {
        echo "Table Name: products - row inserted<br>";
    }
    else
    {
        die("Error inserting rows for products: " . mysqli_error($connection));
    }
}

$prod_id[] = '1'; $cat_id[] = '1';
$prod_id[] = '2'; $cat_id[] = '2';
$prod_id[] = '3'; $cat_id[] = '3';
$prod_id[] = '4'; $cat_id[] = '4';
$prod_id[] = '5'; $cat_id[] = '5';

for ($i=0; $i<count($prod_id); $i++)
{
    $sql = "INSERT INTO products_category (prod_id, cat_id) VALUES ('$prod_id[$i]', '$cat_id[$i]');";

    if (mysqli_query($connection, $sql))
    {
        echo "Table Name: products_category - row inserted<br>";
    }
    else
    {
        die("Error inserting rows for products_category: " . mysqli_error($connection));
    }
}

$cust_id[] = '1'; $total[] = '17999.98';


for ($i=0; $i<count($total); $i++)
{
    $sql = "INSERT INTO orders (cust_id, total) VALUES ('$cust_id[$i]', '$total[$i]');";

    if (mysqli_query($connection, $sql))
    {
        echo "Table Name: orders - row inserted<br>";
    }
    else
    {
        die("Error inserting rows for orders: " . mysqli_error($connection));
    }
}

$order_id[] = '1'; $prod_id[] = '1'; $prod_quantity[] = '2'; $prod_line_cost[] = '17999.98';

for ($i=0; $i<count($order_id); $i++)
{
    $sql = "INSERT INTO products_orders (order_id, prod_id, prod_quantity, product_line_cost) VALUES ('$order_id[$i]', '$prod_id[$i]', '$prod_quantity[$i]', '$prod_line_cost[$i]');";

    if (mysqli_query($connection, $sql))
    {
        echo "Table Name: products_orders - row inserted<br>";
    }
    else
    {
        die("Error inserting rows for products_orders: " . mysqli_error($connection));
    }
}

$slider_img[] = 'images/1.webp'; $prod_id5[] = '1';
$slider_img[] = 'images/2.webp'; $prod_id5[] = '2';
$slider_img[] = 'images/3.webp'; $prod_id5[] = '3';
$slider_img[] = 'images/4.webp'; $prod_id5[] = '4';
$slider_img[] = 'images/5.webp'; $prod_id5[] = '5';
$slider_img[] = 'images/6.webp'; $prod_id5[] = '5';

for ($i=0; $i<count($slider_img); $i++)
{
    $sql = "INSERT INTO slider (slider_img, prod_id) VALUES ('$slider_img[$i]', '$prod_id5[$i]');";

    if (mysqli_query($connection, $sql))
    {
        echo "Table Name: slider - row inserted<br>";
    }
    else
    {
        die("Error inserting rows for slider: " . mysqli_error($connection));
    }
}

$prod_idss[] = '1'; $file_name[] = 'loreal1.jpg';
$prod_idss[] = '1'; $file_name[] = 'loreal2.jpg';
$prod_idss[] = '1'; $file_name[] = 'loreal3.jpg';
$prod_idss[] = '1'; $file_name[] = 'loreal4.jpg';


$prod_idss[] = '2'; $file_name[] = 'facebrush1.jpg';
$prod_idss[] = '2'; $file_name[] = 'facebrush2.jpg';
$prod_idss[] = '2'; $file_name[] = 'facebrush3.jpg';
$prod_idss[] = '2'; $file_name[] = 'facebrush4.jpg';


$prod_idss[] = '3'; $file_name[] = 'aloe1.jpg';
$prod_idss[] = '3'; $file_name[] = 'aloe2.jpg';
$prod_idss[] = '3'; $file_name[] = 'aloe3.jpg';
$prod_idss[] = '3'; $file_name[] = 'aloe4.jpg';


$prod_idss[] = '4'; $file_name[] = 'charcoal1.jpg';
$prod_idss[] = '4'; $file_name[] = 'charcoal2.jpg';
$prod_idss[] = '4'; $file_name[] = 'charcoal3.jpg';
$prod_idss[] = '4'; $file_name[] = 'charcoal4.jpg';


$prod_idss[] = '5'; $file_name[] = 'smooth1.jpg';
$prod_idss[] = '5'; $file_name[] = 'smooth2.jpg';
$prod_idss[] = '5'; $file_name[] = 'smooth3.jpg';
$prod_idss[] = '5'; $file_name[] = 'smooth4.jpg';


$prod_idss[] = '6'; $file_name[] = 'map1.jpg';
$prod_idss[] = '6'; $file_name[] = 'map2.jpg';
$prod_idss[] = '6'; $file_name[] = 'map3.jpg';


$prod_idss[] = '7'; $file_name[] = 'light1.jpg';
$prod_idss[] = '7'; $file_name[] = 'light2.jpg';
$prod_idss[] = '7'; $file_name[] = 'light3.jpg';
$prod_idss[] = '7'; $file_name[] = 'light4.jpg';


$prod_idss[] = '8'; $file_name[] = 'vase1.jpg';
$prod_idss[] = '8'; $file_name[] = 'vase2.jpg';
$prod_idss[] = '8'; $file_name[] = 'vase3.jpg';
$prod_idss[] = '8'; $file_name[] = 'vase4.jpg';


$prod_idss[] = '9'; $file_name[] = 'mirror1.jpg';
$prod_idss[] = '9'; $file_name[] = 'mirror2.jpg';
$prod_idss[] = '9'; $file_name[] = 'mirror3.jpg';
$prod_idss[] = '9'; $file_name[] = 'mirror4.jpg';


$prod_idss[] = '10'; $file_name[] = 'home1.jpg';
$prod_idss[] = '10'; $file_name[] = 'home2.jpg';
$prod_idss[] = '10'; $file_name[] = 'home3.jpg';
$prod_idss[] = '10'; $file_name[] = 'home4.jpg';


$prod_idss[] = '11'; $file_name[] = 'nike.png';
$prod_idss[] = '11'; $file_name[] = 'nike1.png';
$prod_idss[] = '11'; $file_name[] = 'nike3.png';
$prod_idss[] = '11'; $file_name[] = 'nike4.png';


$prod_idss[] = '12'; $file_name[] = 'jordan.jpg';


$prod_idss[] = '13'; $file_name[] = 'tlite1.png';
$prod_idss[] = '13'; $file_name[] = 'tlite3.jpg';


$prod_idss[] = '14'; $file_name[] = '901.jpg';
$prod_idss[] = '14'; $file_name[] = '902.jpg';
$prod_idss[] = '14'; $file_name[] = '903.jpg';


$prod_idss[] = '15'; $file_name[] = '101.jpg';
$prod_idss[] = '15'; $file_name[] = '102.jpg';



$prod_idss[] = '16'; $file_name[] = 'tent.jpg';


$prod_idss[] = '17'; $file_name[] = 'vitus.jpg';


$prod_idss[] = '18'; $file_name[] = 'bike1.jpg';
$prod_idss[] = '18'; $file_name[] = 'bike2.jpg';
$prod_idss[] = '18'; $file_name[] = 'bike3.jpg';


$prod_idss[] = '19'; $file_name[] = 'bike11.jpg';
$prod_idss[] = '19'; $file_name[] = 'bike22.jpg';
$prod_idss[] = '19'; $file_name[] = 'bike33.jpg';


$prod_idss[] = '20'; $file_name[] = 'bike111.jpg';
$prod_idss[] = '20'; $file_name[] = 'bike222.jpg';
$prod_idss[] = '20'; $file_name[] = 'bike333.jpg';


$prod_idss[] = '21'; $file_name[] = 'codliver.jpg';


$prod_idss[] = '22'; $file_name[] = 's1.jpg';
$prod_idss[] = '22'; $file_name[] = 's2.jpg';
$prod_idss[] = '22'; $file_name[] = 's3.jpg';
$prod_idss[] = '22'; $file_name[] = 's4.jpg';


$prod_idss[] = '23'; $file_name[] = 's11.jpg';
$prod_idss[] = '23'; $file_name[] = 's22.jpg';
$prod_idss[] = '23'; $file_name[] = 's33.jpg';
$prod_idss[] = '23'; $file_name[] = 's44.jpg';


$prod_idss[] = '24'; $file_name[] = 's111.jpg';
$prod_idss[] = '24'; $file_name[] = 's222.jpg';
$prod_idss[] = '24'; $file_name[] = 's333.jpg';
$prod_idss[] = '24'; $file_name[] = 's444.jpg';


$prod_idss[] = '25'; $file_name[] = 's1111.jpg';
$prod_idss[] = '25'; $file_name[] = 's2222.jpg';
$prod_idss[] = '25'; $file_name[] = 's3333.jpg';
$prod_idss[] = '25'; $file_name[] = 's4444.jpg';





for ($i=0; $i<count($file_name); $i++)
{
    echo $prod_idss[$i];
    echo "I am I".$i;
    $sql = "INSERT INTO images (file_name, prod_id) VALUES ('$file_name[$i]', '$prod_idss[$i]');";

    if (mysqli_query($connection, $sql))
    {
        echo "Table Name: images - row inserted<br>";
    }
    else
    {
        die("Error inserting rows for images: " . mysqli_error($connection));
    }
}