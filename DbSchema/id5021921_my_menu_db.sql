-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 28, 2018 at 05:00 PM
-- Server version: 10.2.12-MariaDB
-- PHP Version: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id5021921_my_menu_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `food_item`
--

CREATE TABLE `food_item` (
  `slno` int(11) NOT NULL,
  `food_title` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `food_image` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `views_no` int(11) NOT NULL,
  `rating` double NOT NULL,
  `food_type` varchar(20) NOT NULL,
  `food_category` varchar(20) NOT NULL,
  `isavailable` tinyint(1) NOT NULL,
  `isdelete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_item`
--

INSERT INTO `food_item` (`slno`, `food_title`, `description`, `food_image`, `price`, `views_no`, `rating`, `food_type`, `food_category`, `isavailable`, `isdelete`) VALUES
(12, 'Cabbage And Paneer R', 'Paneer RollÂ is a sumptuous treat with a peppy flavor. The crunch of grated cabbage and spring onions together with the succulence of crumbled paneer gives these rolls an awesome mouth-feel, while a dash of hot chili sauce    \r\n                         \r\n                         \r\n                         \r\n                         \r\n                     ', 'creolespicedcornthumb_640x480.jpg', 150, 2, 4.35, 'Veg', 'Soups', 1, 0),
(13, 'babycorn pudhina', 'mint and coriander add an interesting color and flavor to the crunchyÂ baby corn.Â ... Boil theÂ baby cornÂ in salted water till they become soft and are cooked.Â ... Tarla Dalal delighted you loved theÂ Baby CornÂ Phudina recipe.', 'babycorn pudhina.jpg', 120, 1, 5, 'Veg', 'Starters', 1, 0),
(14, 'American Chop Suvey', 'American chop suey is an American pasta dish popular in New England. It is related to other popular and similarly regional pasta dishes, like chili mac. Despite its name, it has only a very distant relation to Chinese and American Chinese cuisine.', 'American Chop Suvey.jpg', 180, 0, 0, 'Veg', 'Starters', 1, 0),
(15, 'Aloo Aur Shakarkand ', 'Aloo aur Shakarkand ki Chaat, most of us consider sweet potatoes (Shakarkand) to be a very boring vegetable, only to be eaten during religious fasts and then too, it is only baked or boiled before it is peeled and eaten.', 'Aloo Aur Shakarkand ki chaat.jpg', 150, 0, 0, 'Veg', 'Starters', 1, 0),
(16, 'Achaari Paneer Tikka', 'achari paneer tikkaÂ recipe with step by step photos â€“ yet another variation of the popular paneer tikka flavored with pickling spices. if you enjoy biting into pickle and relishing the sour taste of lemon or mango then you will like this recipe. you can also check paneer tikka and achari paneer recipe', 'Achaari Paneer Tikka.jpg', 200, 1, 4, 'Veg', 'Starters', 1, 0),
(17, 'DOSA WITH CHICKEN CU', 'Dosa is one of the most popular South Indian recipes which is loved by all.Cumin seeds and cashew with coconut milk made chicken curry very smooth. This is a great combination of Tiffin Items, particularly with Dosa.', 'dosa with chicken curry.JPG', 230, 0, 0, 'Non-Veg', 'Staples', 1, 0),
(18, 'EGG DOSA WITH GRAVIY', 'This dosa recipe is a twist from the traditional dosa. Healthier and even more delicious because of egg with gravity.', 'EGG DOSA WITH GRAVIY.jpg', 160, 0, 0, 'Non-Veg', 'Staples', 1, 0),
(19, 'PENNE ARRABIATA', 'Penna arrabiata, aÂ dishÂ apparently native to Rome,Â is a recipe with quite a bit of spice.Name itself refers to the â€œangryâ€ heat of the chilli-spiked tomato sauce with drained pasta.', 'PENNE ARRABIATA.png', 475, 0, 0, 'Non-Veg', 'Staples', 1, 0),
(20, 'FUSSILY ALFREDO', 'Fussily Alfredo is a pasta dish made from Alfredo, which means no cream, milk, or flour. The sauce is an emulsion of butter and starchy pasta water with lots of pepper.', 'FUSSILY ALFREDO.jpg', 550, 0, 0, 'Non-Veg', 'Staples', 1, 0),
(21, 'MUSHROOM RISOTTO', 'The real magic in this mushroom risotto recipe comes from using mushroom stock. Also risottoÂ hasÂ healthyÂ omega-3 fatty acids, which can reduce inflammation and improve cardiovascularÂ health.', 'MUSHROOM RISOTTO.jpg', 475, 0, 0, 'Non-Veg', 'Staples', 1, 0),
(22, 'Chicken Pepper Soup', 'Â Pulse until everything is a puree. Add to the pot ofÂ chicken, add water about 7-8 cups of water. Bring to a boil and simmer untilÂ chickenÂ is tender. Discard bay leaf, add water if necessary. Adjust for seasonings and thickness. Serve warm.', 'Chicken Pepper Soup.jpg', 150, 0, 0, 'Non-Veg', 'Soups', 1, 0),
(23, 'Mutton Bone Soup', 'specially for my aged Grandmother once in a while. It is very nutritious, easily digestible and tasteful.', 'mutton soup.jpg', 150, 0, 0, 'Non-Veg', 'Soups', 1, 0),
(24, 'Hot and sour Soup', 'a spicy and sour appetising veg clear soup recipe prepared with veg stock which improves digestion and stimulate the appetite. it is typically served before the main course meal even before starters', 'hot and sour soup.jpg', 110, 0, 0, 'Non-Veg', 'Soups', 1, 0),
(25, 'Tori Jiru', 'Japanese cuisine is the foodâ€”ingredients, preparation and way of eatingâ€”of Japan. The phrase ichijÅ«-sansai refers to the makeup of a typical meal served, but has roots in classic kaiseki, honzen, and yÅ«soku cuisine.', 'Tori Jiru.jpg', 275, 0, 0, 'Non-Veg', 'Soups', 1, 0),
(26, 'Tibetan Chicken Brot', 'Tibetan-inhabited areas range over a vast and diverse region,Â TibetanÂ food varies widely. In the fertile valleys of central and easternTibet, many kinds of vegetables .', 'Tibetan Chicken Broth.jpg', 150, 0, 0, 'Non-Veg', 'Soups', 1, 0),
(27, 'Nellore Chicken Biry', 'Â Along withÂ ChickenÂ kurma, I made the simple Ghee Rice and thisÂ chickenÂ Fry which is calledÂ Nellore Chicken. Don\'t ask me why this is calledÂ Nellore chicken, I have no clue.Â NelloreÂ is more of a town in Andhra where I am sure neither chilli sauce nor vinegar might be used for cooking. ', 'Nellore Chicken Biryani.jpg', 240, 2, 4, 'Non-Veg', 'Biryani Items', 1, 0),
(28, 'Nellore Mutton Birya', 'This is aÂ nelloreÂ styleÂ muttonÂ pulav. I learned this from my mom. We grew up eating this on every occasion of childhood life. Weddingsâ€¦EIDâ€¦Getogethersâ€¦.partysâ€¦.ETC. Only after marriage did i learn and taste other type ofÂ biryani\'sÂ and especially hyderabadi kacchibiryani', 'Nellore Mutton Biryani.jpg', 240, 1, 3.6, 'Non-Veg', 'Biryani Items', 1, 0),
(29, 'Hyderabad Chicken Bi', 'Hyderabadi Chicken BiryaniÂ is a non-vegetarian rice dish made with moderate spices and tender chicken pieces. This Indian chicken biryani is slow cooked to perfection and served as a main course.', 'Hyderabad Chicken Biryani.jpg', 300, 0, 0, 'Non-Veg', 'Biryani Items', 1, 0),
(30, 'Nati chicken Biryani', 'Naatu Kozhi Varuval post i have mentioned, that I do not know the difference between the countryÂ chickenÂ and broilerÂ chicken.', 'Nati chicken Biryani.jpg', 240, 0, 0, 'Non-Veg', 'Biryani Items', 1, 0),
(31, 'Egg Chicken Biryani', 'Egg biryaniÂ recipe made with scrambledÂ eggs, flavorful, tasty, quick. recipe available with step by step pictures to make scrambledÂ egg biryani', 'Egg Chicken Biryani.jpg', 150, 0, 0, 'Non-Veg', 'Biryani Items', 1, 0),
(32, 'Chicken Kshatriya', 'Â Kshatriya chickenÂ is a delicious Andhra styleÂ chickenrecipe, It is an easy to make recipe with simple ingredients, a dryÂ chickenÂ recipe popularly served in Andhra restaurants.', 'Chicken Kshatriya.jpg', 200, 0, 0, 'Non-Veg', 'Starters', 1, 0),
(33, 'Chilli Chicken', 'It is a delicious indo- chinese recipe and everyone loves its taste as it goes very well with fried rice or even as a starter.', 'Chilli Chicken.jpg', 230, 0, 0, 'Non-Veg', 'Starters', 1, 0),
(34, 'Lemon Chicken Dry', 'Â lemon chickenÂ recipe yields tender chicken bites with a dominant flavor of lemon juice, mint and mild spices. Slightly tangy, mildly hot with full of flavors.', 'Lemon Chicken Dry.jpg', 260, 0, 0, 'Non-Veg', 'Starters', 1, 0),
(35, 'Chicken Lollipop', 'Indo-Chinese batter-friedÂ chicken lollipop, that\'s juicy on the inside and hot & crunchy on the outside. It pairs well with homemade schezwan sauce', 'chicken lollipop.jpg', 250, 0, 0, 'Non-Veg', 'Starters', 1, 0),
(36, 'Chicken Kabab', ' Fried chicken kebabs, succulent pieces of deep fried chicken with a crispy and flavor packed coating is must try.', 'Chicken Kabab.jpg', 200, 0, 0, 'Non-Veg', 'Starters', 1, 0),
(37, 'Kandhari Murgh Tikka', 'A popular Afghani dish. moist succulent chicken pieces marinated in a thick pomegranate juice and spices. Best served with rotis and naans or parathas.', 'Kandhari Murgh Tikka.jpg', 270, 0, 0, 'Non-Veg', 'Tandoor se', 1, 0),
(38, 'Zaffrani Chandi Ke K', 'One of the most popular grilled food in the world. Chicken with green cardamom and cloves makes it simple yet delicious.', 'Zaffrani Chandi Ke Kabab.jpg', 240, 1, 3.7, 'Non-Veg', 'Tandoor se', 1, 0),
(39, 'Kasoori Murugh ki Me', 'Awesome dried fenugreek flavoured chicken kababs. Its true beauty is unveiled over the glowing embers of a charcoal grill- fuelled by imli ki lakri.', 'Kasoori Murugh ki Methi Seekh.jpg', 250, 0, 0, 'Non-Veg', 'Tandoor se', 1, 0),
(40, 'Kalmi Kerabad', 'Deliciously juicy oven baked boneless chicken kalmi. This recipe calls for potlimasala which is a blend of fragrant spices and is mainly used in hyderabadi cuisines.', 'Kalmi Kerabad.jpg', 240, 0, 0, 'Non-Veg', 'Tandoor se', 1, 0),
(41, 'Tandoori Chicken', 'Absolutely delicious receipe. Chicken marinated in masalas, oil and curd makes it spicy. Grilled and served with onion rings and green chutney.', 'Tandoori Chicken.jpg', 240, 0, 0, 'Non-Veg', 'Tandoor se', 1, 0),
(42, 'Chicken Manchurian', 'Chicken manchurianÂ recipe â€“Â ManchurianÂ is one of the popular Indo chinese recipes that was initially made withÂ chickenÂ and then a lot of vegetarian versions came up like VegÂ manchurian, MushroomÂ manchurian, GobiÂ manchurianÂ and Paneermanchurian.', 'chicken manchurian.jpg', 260, 0, 0, 'Non-Veg', 'Chinese Food', 1, 0),
(43, 'Fish Manchurian', 'Fish ManchurianÂ are the popular Indo-Chinese recipes. These recipes are easy and simple to make at home, you can find Indo-Chinese recipes in many Indian restaurants too.', 'fish-manchurian.jpg', 320, 0, 0, 'Non-Veg', 'Chinese Food', 1, 0),
(44, 'Prawn Manchurian', 'Â Not all Chinese recipes taste the same. Just like India, every part of China has its own set of recipes to offer. TheÂ prawnÂ curry we are talking about is a Chinese recipe from theÂ Manchuriadistrict. It is calledÂ Manchurian prawns.', 'Prawn Manchurian.jpg', 310, 0, 0, 'Non-Veg', 'Chinese Food', 1, 0),
(45, 'Chicken Fried Rice', 'Chicken fried riceÂ is a favourite recipe in India. Rice is stir fried with chicken strips, veggies and sauces in', 'Chicken Fried Rice.jpg', 260, 0, 0, 'Non-Veg', 'Chinese Food', 1, 0),
(46, 'Egg Fried Noodle', 'egg fried riceÂ recipe uses egg that\'s slightly flavored with turmeric and paprika, which I think is a unique addition. It adds color to the dish, making it a vibrant yellow.', 'Egg Fried Noodle.jpg', 230, 0, 0, 'Non-Veg', 'Chinese Food', 1, 0),
(47, 'Radish Soup with Tofu Miso Cream', 'Creamy soup made out of radishes, spring onion, celery and vegetable stock, topped off with luscious cream made of tofu, orange juice and honey.Good for health and delicious in taste.    \r\n                         \r\n                     ', 'radish.jpg', 250, 5, 4.08, 'Veg', 'Soups', 1, 0),
(48, 'Baby Corn Soup', 'A baby corn soup with the goodness of cabbage, capsicum and mushrooms. A delight on a wintery night. ', 'soup_625x350_71449221203.jpg', 210, 2, 4.2, 'Veg', 'Soups', 1, 0),
(49, 'Turnip and Zucchini Soup', 'A very healthy soup with turnips, zucchini and spinach. Makes for a great de-toxifying meal.', 'radish-soup-625_625x350_61443177772.jpg', 290, 0, 0, 'Veg', 'Soups', 1, 0),
(50, 'Fall Vegetable Stew with Mint Pesto', 'Veggies are the star in this dish, and this rich, pureed soup comes together in just a few short minutes.', 'image.jpeg', 270, 4, 4.35, 'Veg', 'Soups', 1, 0),
(51, 'Green Vegetable Soup with Lemon-Basil Pesto', 'Covering the pot when bringing the liquid to a simmer gets this soup ready even faster.\r\n', 'image-2.jpeg', 310, 2, 4.25, 'Veg', 'Soups', 1, 0),
(52, 'Mixed Vegetable Soup', 'This recipe was created with flexibility in mind, and is a great way to use up leftover ingredients.    \r\n                     ', 'mbd105381_0110_soup_009_hd.jpg', 250, 2, 4.8, 'Veg', 'Soups', 1, 0),
(53, 'Hyderabadi Veg Dum Biryani', 'Veg Biryani is a delicious medley of rice, vegetables and a variety of spices. Biryani has a stronger taste of curried rice due to a higher amount of spices.    \r\n                     ', '43113_w1024h768c1cx1600cy1066.jpg', 300, 4, 4.5, 'Veg', 'Biryani Items', 1, 0),
(54, 'CHETTINAD VEGETABLE BIRYANI', 'Chettinad Cuisine is very famous all over the world.The specialty is the usage of Marathi Moggu or Marati Mogga. This Indian Spice is used extensively in Karnatakaâ€™s special Bisi Bele Bath.', 'veg-biryani.jpg', 350, 1, 4.7, 'Veg', 'Biryani Items', 1, 0),
(55, 'Hyderabadi vegetable biryani', 'Hyderabadi vegetable biryani is a vegetable-rich, aromatic dish.yummmy to eat.    \r\n                         \r\n                     ', 'veg_biryani.jpeg', 300, 0, 0, 'Veg', 'Biryani Items', 1, 0),
(56, 'Paneer Biryani', 'Panner biryani is made of paneer and make a recipe using their basmati rice.', 'paneer-biryani-vert3.jpg', 390, 1, 3, 'Veg', 'Biryani Items', 1, 0),
(57, 'Mushroom Rice', 'to make a recipe using their basmati rice.', 'Mushroom Pulao.jpg', 300, 0, 0, 'Veg', 'Biryani Items', 1, 0),
(58, ' Aloo and Dal ki Tikki', 'Bite-sized and absolutely divine made by aloo.', '33-one-bite-starter-recipes_1.jpg', 210, 1, 2.7, 'Veg', 'Starters', 1, 0),
(59, 'Paneer Tikkas', 'To spare for this flavor-packed paneer tikka made by paneer.\r\n', 'paneer-tikka-625_625x350_81436947019.jpg', 210, 0, 0, 'Veg', 'Starters', 1, 0),
(60, 'Fried Onion Rings', 'Crispy onion rings are the best stater for dinner .', 'fried-onion-rings_240x180_71513755428.jpg', 200, 0, 0, 'Veg', 'Starters', 1, 0),
(61, 'Fried Cheese Cubes', 'Fried Cheese Cubes are good for health and tastes yummy..!', 'fried-cheese-cubes_240x180_51514461858.jpg', 230, 0, 0, 'Veg', 'Starters', 1, 0),
(62, 'Tandoori Gobhi', 'Tandoori Gobhi is one of the favourite Indian food item .', 'tandoori-gobhi_240x180_61513143669.jpg', 250, 0, 0, 'Veg', 'Starters', 1, 0),
(63, 'Canned Beans', 'The canned beansis made up of crispy chick peaks and mixed with fruits.', 'sdfgh.jpeg', 210, 2, 4, 'Veg', 'Staples', 1, 0),
(64, ' Tahini', ' Tahini is that magic ingredient that seems to make any vegetarian meal better. ', '37a1ed7f1299e321d78eccad99b2b265ac83a99a.jpeg', 300, 2, 4, 'Veg', 'Staples', 1, 0),
(65, 'Avocados', 'Add avocado slices to grain bowls, and blitz up an avocado to make my favorite pasta sauce', '0c331d0134125d389b2118652b6215d25018a342.jpeg', 250, 3, 3.8, 'Veg', 'Staples', 1, 0),
(66, 'Canned Coconut Milk', 'Canned coconut milk is a staple we add brown rice in this staple.', '95a2f87d44a4e8e6b42f2493c0d9ca773e0d6a89.jpeg', 29, 1, 5, 'Veg', 'Staples', 1, 0),
(67, 'BOULDIN CREEK CAFE', 'Bouldin Creek\'s inevitably robust brunch line because they\'re hopelessly hooked on the vegan chorizo', 'tl-horizontal_main.jpg', 250, 0, 0, 'Veg', 'Staples', 1, 0),
(68, 'Naked Cherry Tomato Salad', 'Naked Cherry Tomato Salad is a salad made up of tomatoes looks good and tasty.', '3983175.jpg', 180, 2, 4, 'Veg', 'Salads', 1, 0),
(69, 'Corn Salad', 'This fresh and flavorful salad features buttery yellow corn tossed with chunks of tomato and onion with a fresh basil vinaigrette', '1169760.jpg', 210, 2, 5, 'Veg', 'Salads', 1, 0),
(70, 'Russian Carrot Salad ', 'It is so absolutely ubiquitous in Russia.Coriander provides primary flavor to it.', '2841046.jpg', 210, 2, 5, 'Veg', 'Salads', 1, 0),
(71, 'Artichoke Salad', 'Artichoke Salad is a flavorful Italian-style salad.', '2123176.jpg', 210, 1, 5, 'Veg', 'Salads', 1, 0),
(72, 'White Bean Salad', 'White Bean Salad is a flavorful cold salad.', '1278367.jpg', 250, 1, 3, 'Veg', 'Salads', 1, 0),
(73, 'Chilli Chicken', 'It is made with coated chicken with a soya sauce marinade adding the Chinese element.', 'chilli-chicken-625_625x350_41441392260.jpg', 310, 1, 5, 'Veg', 'Chinese Food', 1, 0),
(74, ' Chicken Manchurian ', ' Chicken Manchurian has ingredients like garlic, ginger, chilli and just added a splash of soya sauce.', 'manchurian-625_625x350_81441392055.jpg', 410, 1, 5, 'Veg', 'Chinese Food', 1, 0),
(75, 'Chowmein', ' In China, chowmein is referred to as chÄu-mÃ¨ing and is basically a portion of boiled noodles topped with greens, scrambled eggs and soya sauce. ', 'noodles-625_625x350_51441392094.jpg', 450, 1, 5, 'Veg', 'Chinese Food', 1, 0),
(76, 'Spring Rolls', 'The Chinese call it ChÅ«n JuÇŽn and are actually Cantonese-style dumplings made for welcoming spring.', 'spring-rolls-625_625x350_71441392136.jpg', 450, 0, 0, 'Veg', 'Chinese Food', 1, 0),
(77, 'Chop Suey', 'These noodles are a really popular side dish, tossed with greens like cabbage and capsicum, chicken or shrimp and sweetish chilli garlic sauce.', 'chicken-noodles-625_625x350_51441392182.jpg', 410, 0, 0, 'Veg', 'Chinese Food', 1, 0),
(78, 'Aloo Paratha', 'Soft dough stuffed with the spicy filling of mashed potatoes with coriander, chillies and other spices and then rolled out into big round parathas.', 'paratha-625_625x350_61446476643.jpg', 210, 1, 4.8, 'Veg', 'Indian Breads', 1, 0),
(79, 'Malabar Paratha', 'The quintessential classic from \'God\'s own country\' is this flaky bread. Relish the delicate texture of the authentic Malabar paratha along with a bowl of mutton stew. ', 'paratha_625x350_51464781029.jpg', 210, 0, 0, 'Veg', 'Indian Breads', 1, 0),
(80, ' Poori', 'One of the most loved and relished foods of the country. Wheat flour worked up in a dough, made into balls, rolled out and deep fried to perfect golden brown.', 'poori_625x350_41460704245.jpg', 180, 1, 1.8, 'Veg', 'Indian Breads', 1, 0),
(81, 'Pav Bhaji', 'One of the most loved breakfast dishes, pav bhaji is a perfect combination of tangy and spicy.', 'pav-bhaji_625x350_81449563929.jpg', 210, 1, 4.6, 'Veg', 'Indian Breads', 1, 0),
(82, ' Appam', 'A  handful of ingredients is all that you need to create these magical, feather-light appams.', 'appam_625x350_51465973845.jpg', 210, 0, 0, 'Veg', 'Indian Breads', 1, 0),
(83, 'Cheese cake', 'Cheesecake is a sweet dessert consisting of one or more layers. The main, and thickest layer, consists of a mixture of soft, fresh cheese, eggs, and sugar.', '1387411272847.jpeg', 310, 2, 5, 'Veg', 'Sweet and Deserts', 1, 0),
(84, 'Sorbet', 'Sorbet is a frozen dessert made from sweetened water with flavoring Contents.', '1200px-RaspberrySherbet.jpg', 210, 0, 0, 'Veg', 'Sweet and Deserts', 1, 0),
(85, 'Sundae', 'The sundae is a sweet ice cream dessert. It typically consists of one or more scoops of ice cream.', 'StrawberrySundae.jpg', 210, 0, 0, 'Veg', 'Sweet and Deserts', 1, 0),
(87, 'Panna cotta', 'Panna cotta is an Italian dessert of sweetened cream thickened with gelatin and molded.', 'panna-cotta.jpg', 210, 0, 0, 'Veg', 'Sweet and Deserts', 1, 0),
(88, 'Yule log', 'Made of sponge cake to resemble a miniature actual Yule log, it is a form of sweet roulade.', 'images.jpeg', 310, 0, 0, 'Veg', 'Sweet and Deserts', 1, 0),
(89, ' Lemon Chicken ', 'Lemon, chicken, dried chilli, garlic and some seriously delectable sugarcane juice is all you need for this fantastic recipe.\r\n', 'indian-dinner_625x350_71434359756.jpg', 200, 0, 0, 'Veg', 'Main Courses', 1, 0),
(90, ' Shahi Egg Curry', 'A mildly-spiced egg curry made with garlic, onions, a whole lot of kasuri methi, fresh cream, yogurt and fresh coriander.\r\n', 'indian-dinner_625x350_61434362285.jpg', 210, 0, 0, 'Veg', 'Main Courses', 1, 0),
(91, ' Malabari Prawn Curry ', 'A  light prawn curry cooked with grated coconut, coriander seeds, ginger, chilli and some shallots.', 'indian-dinner_625x350_71434362500.jpg', 250, 0, 0, 'Veg', 'Main Courses', 1, 0),
(93, 'South Indian Meals', 'South Indian Meals is the most famous and tasty food.', 'andhra_plaintainleaf_meals.jpg', 270, 0, 0, 'Veg', 'Main Courses', 1, 0),
(94, ' Dal Makhani', ' Dal Makhani is  one of the most popular forms of dal.', 'indian-dinner_625x350_81434363127-2.jpg', 210, 0, 0, 'Veg', 'Main Courses', 1, 0),
(95, 'Morning Special ', '2 Dosa + Vada at Rs.50', 'offers_veg3.jpg', 50, 4, 4.4, 'Veg', 'Offers', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `placed_order`
--

CREATE TABLE `placed_order` (
  `slno` int(11) NOT NULL,
  `customer_name` varchar(20) NOT NULL,
  `table_id` varchar(20) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isActive` tinyint(1) NOT NULL,
  `amount` double NOT NULL,
  `bill_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bill_passed_by` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `placed_order`
--

INSERT INTO `placed_order` (`slno`, `customer_name`, `table_id`, `order_date`, `isActive`, `amount`, `bill_date`, `bill_passed_by`) VALUES
(1, 'Jai', 'tab1', '2018-03-21 11:44:37', 0, 0, '2018-03-21 11:44:37', 'jai@mine.com'),
(2, 'jai', 'tab1', '2018-03-22 08:42:51', 0, 0, '2018-03-22 08:42:51', 'jai@mine.com'),
(3, 'Hi', 'tab1', '2018-03-22 11:42:57', 0, 0, '2018-03-22 11:42:57', 'jai@mine.com'),
(4, 'Jai', 'tab1', '2018-03-23 04:26:17', 0, 0, '0000-00-00 00:00:00', NULL),
(5, 'Jai', 'tab2', '2018-03-23 04:31:21', 0, 0, '0000-00-00 00:00:00', NULL),
(6, 'Jai', 'tab1', '2018-03-23 04:37:18', 0, 0, '0000-00-00 00:00:00', NULL),
(7, 'Jai', 'tab1', '2018-03-23 04:40:36', 0, 0, '0000-00-00 00:00:00', NULL),
(8, 'Jai', 'tab1', '2018-03-23 04:47:19', 0, 0, '0000-00-00 00:00:00', NULL),
(9, '', 'tab2', '2018-03-23 07:19:09', 0, 0, '2018-03-23 07:19:09', 'jai@mine.com'),
(10, 'mmr', 'tab2', '2018-03-23 07:19:21', 0, 0, '0000-00-00 00:00:00', NULL),
(11, 'Jai', 'tab1', '2018-03-23 08:02:04', 0, 0, '0000-00-00 00:00:00', NULL),
(12, 'Jai', 'tab1', '2018-03-23 08:55:43', 0, 0, '0000-00-00 00:00:00', NULL),
(13, 'jai', 'tab1', '2018-03-23 09:16:57', 0, 0, '0000-00-00 00:00:00', NULL),
(14, 'hi', 'tab1', '2018-03-23 09:43:56', 0, 0, '0000-00-00 00:00:00', NULL),
(15, 'jai', 'tab1', '2018-03-23 09:55:19', 0, 0, '0000-00-00 00:00:00', NULL),
(16, 'jai', 'tab1', '2018-03-23 11:09:56', 0, 0, '2018-03-23 11:09:56', 'jai@mine.com'),
(17, 'jai', 'tab1', '2018-03-23 11:19:32', 0, 0, '0000-00-00 00:00:00', NULL),
(18, 'Jai', 'tab1', '2018-03-24 07:54:32', 0, 0, '2018-03-24 07:54:32', 'jai@mine.com'),
(19, 'pooji', 'tab3', '2018-03-24 09:12:44', 0, 0, '0000-00-00 00:00:00', NULL),
(20, 'Jai', 'tab3', '2018-03-26 04:52:50', 0, 0, '0000-00-00 00:00:00', NULL),
(21, '100rb', 'tab3', '2018-03-26 10:40:18', 0, 0, '2018-03-26 10:40:18', 'jai@mine.com'),
(22, 'Jai', 'tab3', '2018-03-26 12:28:06', 0, 0, '2018-03-26 12:28:06', 'jai@mine.com'),
(23, 'Jai', 'tab3', '2018-03-26 12:28:17', 0, 0, '0000-00-00 00:00:00', NULL),
(24, 'Jai', 'tab3', '2018-03-26 12:30:29', 0, 0, '0000-00-00 00:00:00', NULL),
(25, 'jai', 'tab3', '2018-03-28 12:44:20', 0, 2520, '2018-03-28 12:44:20', 'jai'),
(26, 'Jai', 'tab1', '2018-03-27 02:43:21', 0, 0, '2018-03-27 02:43:21', 'jai@mine.com'),
(27, 'Chandu', 'tab1', '2018-03-27 07:14:10', 0, 0, '2018-03-27 07:14:10', 'cook@orderit.com'),
(28, 'Chandu Jai', 'tab1', '2018-03-28 12:26:59', 0, 1020, '0000-00-00 00:00:00', 'jai'),
(29, 'kiran', 'tab1', '2018-03-28 12:30:45', 0, 0, '0000-00-00 00:00:00', NULL),
(30, 'jai', 'tab1', '2018-03-28 12:32:47', 0, 0, '0000-00-00 00:00:00', NULL),
(31, 'echi', 'tab1', '2018-03-28 12:42:02', 1, 0, '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `placed_order_items`
--

CREATE TABLE `placed_order_items` (
  `slno` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `food_item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `process` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `placed_order_items`
--

INSERT INTO `placed_order_items` (`slno`, `order_id`, `food_item_id`, `quantity`, `process`) VALUES
(23, 1, 12, 1, 1),
(24, 1, 47, 3, 1),
(25, 1, 48, 1, 1),
(26, 2, 53, 1, 1),
(27, 2, 54, 1, 1),
(28, 2, 54, 3, 1),
(29, 3, 95, 2, 1),
(30, 3, 12, 3, 1),
(31, 9, 53, 1, 1),
(32, 16, 50, 1, 1),
(33, 16, 52, 1, 1),
(34, 18, 13, 1, 1),
(35, 18, 13, 2, 1),
(36, 18, 16, 1, 1),
(37, 21, 47, 2, 1),
(38, 21, 50, 1, 1),
(39, 21, 95, 4, 1),
(40, 22, 53, 1, 1),
(41, 26, 28, 1, 1),
(42, 26, 27, 1, 1),
(43, 27, 73, 1, 1),
(44, 27, 74, 2, 1),
(45, 27, 75, 1, 1),
(46, 28, 69, 1, 1),
(47, 28, 70, 1, 1),
(48, 28, 68, 1, 1),
(49, 28, 71, 1, 1),
(50, 28, 72, 1, 1),
(51, 29, 68, 1, 1),
(52, 29, 69, 1, 1),
(53, 29, 70, 1, 1),
(54, 30, 63, 1, 1),
(55, 30, 64, 1, 1),
(56, 30, 65, 1, 1),
(57, 30, 66, 1, 1),
(58, 31, 63, 1, 1),
(59, 31, 64, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tabs`
--

CREATE TABLE `tabs` (
  `slno` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `table_id` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `isactive` tinyint(1) NOT NULL,
  `islogin` tinyint(1) NOT NULL,
  `isdelete` tinyint(1) NOT NULL,
  `checkout_status` tinyint(1) NOT NULL DEFAULT 0,
  `water_req` tinyint(1) NOT NULL DEFAULT 0,
  `helper_req` tinyint(1) NOT NULL DEFAULT 0,
  `bowl_req` tinyint(1) NOT NULL DEFAULT 0,
  `isorder` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabs`
--

INSERT INTO `tabs` (`slno`, `name`, `table_id`, `password`, `isactive`, `islogin`, `isdelete`, `checkout_status`, `water_req`, `helper_req`, `bowl_req`, `isorder`) VALUES
(23, 'Table1', 'tab1', '1234', 0, 1, 0, 0, 0, 0, 0, 0),
(24, 'Table2', 'tab2', '1234', 0, 0, 0, 0, 0, 0, 0, 0),
(25, 'Table3', 'tab3', '1234', 0, 0, 0, 0, 0, 0, 0, 0),
(26, 'Table4', 'tab4', '1234', 0, 0, 0, 0, 0, 0, 0, 0),
(27, 'Table5', 'tab5', '1234', 0, 0, 0, 0, 0, 0, 0, 0),
(28, 'l', 'k', '1', 0, 0, 1, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `slno` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `mobile` bigint(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_type` varchar(20) NOT NULL,
  `isdelete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`slno`, `user_name`, `mobile`, `email`, `password`, `create_date`, `user_type`, `isdelete`) VALUES
(1, 'Jai', 9000204595, 'jai@mine.com', '4123', '2018-03-21 05:19:51', 'Admin', 0),
(4, 'keerthi', 9701841415, 'keerthi@gmail.com', '123!@#abcD', '2018-03-14 16:02:00', 'User', 0),
(5, 'Cook', 9000204595, 'cook@orderit.com', 'Orderit@c', '2018-03-27 05:59:54', 'User', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food_item`
--
ALTER TABLE `food_item`
  ADD PRIMARY KEY (`slno`),
  ADD UNIQUE KEY `food_title` (`food_title`,`food_type`);

--
-- Indexes for table `placed_order`
--
ALTER TABLE `placed_order`
  ADD PRIMARY KEY (`slno`),
  ADD KEY `table_id` (`table_id`);

--
-- Indexes for table `placed_order_items`
--
ALTER TABLE `placed_order_items`
  ADD PRIMARY KEY (`slno`) USING BTREE,
  ADD KEY `order_id` (`order_id`),
  ADD KEY `food_item_id` (`food_item_id`);

--
-- Indexes for table `tabs`
--
ALTER TABLE `tabs`
  ADD PRIMARY KEY (`slno`),
  ADD UNIQUE KEY `table_id` (`table_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`slno`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food_item`
--
ALTER TABLE `food_item`
  MODIFY `slno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `placed_order`
--
ALTER TABLE `placed_order`
  MODIFY `slno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `placed_order_items`
--
ALTER TABLE `placed_order_items`
  MODIFY `slno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `tabs`
--
ALTER TABLE `tabs`
  MODIFY `slno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `slno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `placed_order`
--
ALTER TABLE `placed_order`
  ADD CONSTRAINT `placed_order_ibfk_1` FOREIGN KEY (`table_id`) REFERENCES `tabs` (`table_id`) ON UPDATE CASCADE;

--
-- Constraints for table `placed_order_items`
--
ALTER TABLE `placed_order_items`
  ADD CONSTRAINT `placed_order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `placed_order` (`slno`) ON UPDATE CASCADE,
  ADD CONSTRAINT `placed_order_items_ibfk_2` FOREIGN KEY (`food_item_id`) REFERENCES `food_item` (`slno`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
