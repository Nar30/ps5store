<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['game'])) {
    $game = $_POST['game'];
    $price = $_POST['price'];

    // Store game in session cart
    $_SESSION['cart'][] = ["game" => $game, "price" => $price];

    // Redirect to cart.php to prevent duplicate submissions
    header("Location: cart.php");
    exit();
}

// Games available
$games = [
    [
        "name" => "Red Dead Redemption 2",
        "image" => "images/rdr2.jpg",
        "price" => 1550.00,
        "desc" => "Step into the Wild West in this breathtaking open-world adventure. Experience an emotional story, realistic gunfights, and deep survival mechanics. Every choice you make impacts the world around you."
    ],
    [
        "name" => "Grand Theft Auto V",
        "image" => "images/gta.jpg",
        "price" => 1250.00,
        "desc" => "Explore the sprawling open world of Los Santos in Grand Theft Auto V. Engage in high-stakes heists, experience an epic story, and immerse yourself in GTA Online's limitless multiplayer mayhem."
    ],    
    [
        "name" => "NBA 2K25",
        "image" => "images/nba2k25.jpeg",
        "price" => 1450.00,
        "desc" => "Take your skills to the court with enhanced gameplay and ultra-realistic graphics. Build your dream team in MyTEAM or dominate in MyCAREER mode. Experience the most immersive basketball simulation ever created."
    ],
    [
        "name" => "Assassin's Creed Shadows",
        "image" => "images/ACS.jpeg",
        "price" => 3795.00,
        "desc" => "Step into the world of feudal Japan as a stealthy shinobi warrior. Master parkour, katana combat, and strategic assassinations in a living, breathing historical world. Every mission shapes your path and destiny."
    ],
    [
        "name" => "God of War",
        "image" => "images/GOWR.jpg",
        "price" => 3490.00,
        "desc" => "Embark on a mythical journey as Kratos and Atreus battle Norse gods and legendary creatures. With epic combat, stunning visuals, and an emotional storyline, this is an unforgettable adventure. Unleash the power of the Leviathan Axe and face your fate."
    ],
    [
        "name" => "Monster Hunter Wilds",
        "image" => "images/MHW.jpg",
        "price" => 2995.00,
        "desc" => "Set in the Forbidden Lands, a mysterious and uncharted region, players take on the role of a Hunter investigating the disappearance of an expedition team. This world is both breathtaking and dangerous, teeming with life and hidden secrets that tie into the gamees deeper lore."
    ],
    [
        "name" => "Minecraft",
        "image" => "images/MC.jpg",
        "price" => 1690.00,
        "desc" => "Minecraft serves as a sandbox video game which Mojang Studios developed through the creation of Markus Notch Persson in 2011. The main draw of the game emerges from its infinite creative potential and the ability to discover and construct bases in its block-shaped procedural world."
    ],
    [
        "name" => "Spider-Man 2",
        "image" => "images/SPDM.jpg",
        "price" => 3490.00,
        "desc" => "The game offers an opportunity to play Peter and Miles as the characters hold their own distinct powers where Peter gains abilities from the symbiote and Miles controls venom-based powers."
    ],
    [
        "name" => "Sparking! ZERO",
        "image" => "images/SZERO.jpg",
        "price" => 3050.00,
        "desc" => "Unleash explosive battles in this next-gen Dragon Ball Z fighting game. Experience high-speed combat, destructible environments, and an extensive roster of fighters in the ultimate Budokai Tenkaichi revival."
    ],
    [
        "name" => "Hogwarts Legacy",
        "image" => "images/Hogwarts.jpg",
        "price" => 2995.00,
        "desc" => "Hogwarts Legacy is an open-world action RPG set in the 1800s Wizarding World. Players explore Hogwarts, Hogsmeade, and beyond while learning spells, brewing potions, and uncovering a secret that could change magic forever."
    ],
    [
        "name" => "Elden Ring: Night Rein",
        "image" => "images/elden.jpg",
        "price" => 2500.99,
        "desc" => "Venture into the cursed lands of Night Rein, where eternal darkness shrouds the realm. Face new legendary bosses, uncover ancient secrets, and wield forbidden magic in this epic expansion of Elden Ring."
    ],
    [
        "name" => "Forza Horizon 5",
        "image" => "images/Forza5.jpg",
        "price" => 2800.00,
        "desc" => "Race across the stunning landscapes of Mexico in the ultimate open-world driving experience. Customize your cars, compete in dynamic events, and explore a vibrant world in Forza Horizon 5."
    ],
    [
        "name" => "Call of Duty: Black Ops 6",
        "image" => "images/cod6.jpg",
        "price" => 3500.00,
        "desc" => "Experience the intense action of Black Ops 6, set during the early 1990s. Engage in a gripping campaign, tactical multiplayer battles, and classic Zombies mode in this latest installment of the legendary franchise."
    ],
    [
        "name" => "WWE 2K25",
        "image" => "images/WWE2K25.jpg",
        "price" => 3000.00,
        "desc" => "Step into the ring with WWE 2K25, featuring the most immersive wrestling experience yet. Play as legendary superstars, create your own wrestler, and dominate the squared circle with stunning visuals and enhanced gameplay."
    ],
    [
        "name" => "Metal Gear Solid: Snake Eater",
        "image" => "images/mgs.jpg",
        "price" => 3000.00,
        "desc" => "Relive the origins of the legendary Big Boss in Metal Gear Solid: Snake Eater. Experience intense stealth action, a gripping Cold War-era story, and survival mechanics in this masterfully remastered classic."
    ],
    [
        "name" => "Ghost of Tsushima",
        "image" => "images/ghostof.jpg",
        "price" => 3500.00,
        "desc" => "Embark on an epic journey as Jin Sakai, a samurai warrior fighting to reclaim his homeland. Master the way of the Ghost, explore a stunning open world, and engage in cinematic katana combat in Ghost of Tsushima."
    ],    
    [
        "name" => "Horizon Forbidden West",
        "image" => "images/horizon.jpg",
        "price" => 2594.00,
        "desc" => "Join Aloy as she ventures into the Forbidden West, a majestic yet dangerous frontier filled with new threats, stunning landscapes, and powerful machines in this critically acclaimed action RPG."
    ],
    [
        "name" => "UFC 5",
        "image" => "images/ufc.jpg",
        "price" => 3695.00,
        "desc" => "Step into the Octagon with UFC 5, featuring realistic fighter animations, enhanced grappling mechanics, and next-gen visuals. Compete in intense battles and rise to the top of the MMA world."
    ],
    [
        "name" => "Tekken 8",
        "image" => "images/Tekken8.jpg",
        "price" => 3800.00,
        "desc" => "Experience the next chapter in the legendary fighting game series with Tekken 8. Featuring stunning visuals, new mechanics, and an explosive roster of fighters, prepare for the ultimate battle."
    ],
    [
        "name" => "Days Gone Remastered",
        "image" => "images/daysg.jpg",
        "price" => 3000.00,
        "desc" => "Survive the post-apocalyptic world in Days Gone Remastered. Experience enhanced graphics, improved gameplay mechanics, and all-new content as you ride through the untamed wilderness filled with dangers."
    ],
    [
        "name" => "Dragon's Dogma 2",
        "image" => "images/dragonsd.jpg",
        "price" => 2895.00,
        "desc" => "Embark on an epic journey in Dragon's Dogma 2, an immersive open-world RPG. Battle towering creatures, forge your own destiny, and command powerful Pawns in this highly anticipated sequel."
    ],
    [
        "name" => "Black Myth: Wukong",
        "image" => "images/blackmyth.jpg",
        "price" => 3500.99,
        "desc" => "Step into the legend of the Monkey King in Black Myth: Wukong. Experience stunning visuals, intense combat, and a mythical journey inspired by Journey to the West in this action RPG."
    ],
    [
        "name" => "Rise of the Ronin",
        "image" => "images/ronin.jpg",
        "price" => 3490.00,
        "desc" => "Forge your path as a masterless samurai in Rise of the Ronin. Explore a war-torn Japan, engage in dynamic sword combat, and shape history in this epic open-world action RPG."
    ],
    [
        "name" => "Silent Hill 2 Remake",
        "image" => "images/silent2.jpg",
        "price" => 3200.00,
        "desc" => "Return to the eerie town of Silent Hill in this stunning remake of the psychological horror classic. Experience enhanced visuals, reimagined gameplay, and an immersive atmosphere that brings James Sunderland’s story to life like never before."
    ],
    [
        "name" => "Like a Dragon: Pirate Yakuza in Hawaii",
        "image" => "images/yakuza.jpg",
        "price" => 2500.00,
        "desc" => "Set sail for adventure in Like a Dragon: Pirate Yakuza in Hawaii! Explore the tropical paradise of Hawaii, engage in high-stakes battles, and embrace the chaos of the criminal underworld with a pirate twist in this action-packed RPG."
    ],
    [
        "name" => "Final Fantasy VII Rebirth",
        "image" => "images/ff7.jpg",
        "price" => 1995.00,
        "desc" => "Continue the epic journey of Cloud and his allies in Final Fantasy VII Rebirth. Experience stunning visuals, an expanded world, and intense real-time combat in the highly anticipated sequel to Final Fantasy VII Remake."
    ],
    [
        "name" => "Spider-Man: Miles Morales",
        "image" => "images/miles.jpg",
        "price" => 2490.00,
        "desc" => "Swing into action as Miles Morales in this thrilling Spider-Man adventure. Master explosive bio-electric powers, uncover hidden threats, and protect New York City in this stunning open-world superhero experience."
    ],
    [
        "name" => "FIFA 25",
        "image" => "images/fc25.png",
        "price" => 3500.00,
        "desc" => "Experience the next evolution of football gaming in FIFA 25. With enhanced graphics, realistic gameplay, and new career mode features, take your team to glory on the biggest stage."
    ],
    [
        "name" => "Cyberpunk 2077",
        "image" => "images/cyber.jpg",
        "price" => 2800.00,
        "desc" => "Immerse yourself in the futuristic world of Night City in Cyberpunk 2077. Play as V, a mercenary seeking immortality, in this open-world RPG featuring deep storytelling, intense combat, and breathtaking visuals."
    ],
    [
        "name" => "The Witcher 3: Wild Hunt",
        "image" => "images/witcher3.jpg",
        "price" => 2500.00,
        "desc" => "Embark on an epic journey as Geralt of Rivia in The Witcher 3: Wild Hunt. Hunt monsters, navigate political intrigue, and explore a vast open world filled with stunning landscapes and immersive storytelling."
    ],
    [
        "name" => "Assassin's Creed Valhalla",
        "image" => "images/valhalla.jpg",
        "price" => 2500.00,
        "desc" => "Lead your Viking clan to glory in Assassin's Creed Valhalla. Raid, conquer, and forge alliances in a vast open world set in the age of the Norse warriors, with deep RPG mechanics and brutal combat."
    ],
    [
        "name" => "Astro Bot",
        "image" => "images/astro.jpg",
        "price" => 1500.00,
        "desc" => "Embark on a charming and action-packed platforming adventure with Astro Bot. Explore vibrant worlds, solve puzzles, and utilize innovative gameplay mechanics in this delightful PlayStation exclusive."
    ],
    [
        "name" => "Assassin's Creed Mirage",
        "image" => "images/mirage.jpg",
        "price" => 3100.00,
        "desc" => "Step into the shoes of Basim, a cunning street thief seeking answers in ninth-century Baghdad. Experience classic stealth gameplay, parkour, and thrilling assassinations in Assassin's Creed Mirage."
    ],
    [
        "name" => "Naruto x Boruto: Ultimate Ninja Storm Connections",
        "image" => "images/connections.jpg",
        "price" => 3400.00,
        "desc" => "Relive the epic battles of Naruto and Boruto in the ultimate ninja showdown. Featuring the largest roster in the series, new gameplay mechanics, and an original story mode."
    ],
    [
        "name" => "Alan Wake 2",
        "image" => "images/wake.jpg",
        "price" => 3000.99,
        "desc" => "Step into a psychological horror experience like no other. Unravel the dark mystery surrounding Alan Wake in this gripping sequel filled with intense survival horror gameplay and a chilling narrative."
    ],
    [
        "name" => "Street Fighter 6",
        "image" => "images/sf6.jpg",
        "price" => 3000.99,
        "desc" => "Enter the next evolution of fighting games with Street Fighter 6. Master new mechanics, challenge opponents worldwide, and experience stunning visuals in this legendary franchise's latest installment."
    ],
    [
        "name" => "Sekiro: Shadows Die Twice",
        "image" => "images/sekiro.jpg",
        "price" => 3199.99,
        "desc" => "Embark on a brutal journey of revenge in Sekiro: Shadows Die Twice. Master the art of sword combat, stealth, and supernatural abilities in this critically acclaimed action-adventure set in Sengoku-era Japan."
    ],
    [
        "name" => "Monster Hunter Rise",
        "image" => "images/rise.png",
        "price" => 2995.99,
        "desc" => "Rise to the challenge and join the hunt in Monster Hunter Rise. Explore vibrant ecosystems, battle fearsome monsters, and utilize the new Wirebug mechanic to traverse the world like never before."
    ],
    [
        "name" => "Lies of P",
        "image" => "images/lies.jpg",
        "price" => 2949.99,
        "desc" => "Unravel the dark secrets of Krat in Lies of P, a thrilling souls-like reimagining of the Pinocchio tale. Engage in brutal combat, craft deadly weapons, and shape your fate with a deep narrative-driven experience."
    ],
    [
        "name" => "Far Cry 6",
        "image" => "images/cry6.jpg",
        "price" => 1999.99,
        "desc" => "Join the revolution in Far Cry 6, set in the tropical paradise of Yara. Take on the oppressive regime of Anton Castillo with guerrilla warfare, powerful weapons, and open-world chaos."
    ],    
    [
        "name" => "Indiana Jones and the Great Circle",
        "image" => "images/greatcircle.jpg",
        "price" => 2399.99,
        "desc" => "Embark on an epic adventure with Indiana Jones in The Great Circle. Solve ancient mysteries, uncover hidden treasures, and experience thrilling action in this cinematic, story-driven game."
    ],
    [
        "name" => "Baldur's Gate 3",
        "image" => "images/baldurs.jpg",
        "price" => 2999.99,
        "desc" => "Venture into the Forgotten Realms in this critically acclaimed RPG. Assemble your party, make impactful choices, and engage in deep tactical combat in a world shaped by your decisions."
    ],
    [
        "name" => "F1 24",
        "image" => "images/f1.jpg",
        "price" => 3195.99,
        "desc" => "Experience the thrill of Formula 1 racing with F1 24. Compete in the official championship, master realistic handling, and feel the intensity of high-speed racing with stunning visuals and dynamic weather."
    ],
    [
        "name" => "Palworld",
        "image" => "images/palworld.jpg",
        "price" => 759.99,
        "desc" => "Survive and thrive in the open-world adventure of Palworld. Capture and train mysterious creatures, build your base, and explore a vast land filled with dangers and opportunities."
    ],
    [
        "name" => "It Takes Two",
        "image" => "images/ittakes.jpg",
        "price" => 789.99,
        "desc" => "Embark on a heartfelt co-op adventure in It Takes Two. Solve creative puzzles, overcome platforming challenges, and experience a touching story about love and teamwork."
    ],
    [
        "name" => "Undisputed",
        "image" => "images/undisputed.jpg",
        "price" => 795.99,
        "desc" => "Step into the ring with Undisputed, the ultimate boxing simulation. Experience realistic movement, strategic gameplay, and an authentic roster of world-class fighters."
    ],
    [
        "name" => "Balatro",
        "image" => "images/balatro.jpg",
        "price" => 591.99,
        "desc" => "A strategic deck-building roguelike that blends poker mechanics with unique power-ups. Craft powerful hands, unlock new strategies, and conquer increasingly challenging opponents."
    ],
    [
        "name" => "Metaphor: ReFantazio",
        "image" => "images/metaphor.jpg",
        "price" => 2985.99,
        "desc" => "Embark on a grand fantasy adventure in Metaphor: ReFantazio, a turn-based RPG from the creators of Persona. Explore a richly detailed world, master powerful abilities, and uncover a compelling story of destiny and ambition."
    ],
    [
        "name" => "Hades",
        "image" => "images/hades.jpg",
        "price" => 1389.99,
        "desc" => "Battle through the Underworld as Zagreus, the son of Hades, in this rogue-like dungeon crawler. Master divine powers, forge powerful relationships, and escape the realm of the dead in this critically acclaimed action RPG."
    ],
    [
        "name" => "Kunitsu-Gami: Path of the Goddess",
        "image" => "images/kunitsu.jpg",
        "price" => 2899.00,
        "desc" => "Defend a sacred mountain from demonic corruption in Kunitsu-Gami: Path of the Goddess. Blend action and strategy as you guide a divine maiden through perilous landscapes, battling malevolent spirits in this unique and visually stunning adventure."
    ],
    [
        "name" => "God Eater 3",
        "image" => "images/godeater.jpg",
        "price" => 1950.99,
        "desc" => "Join the fight against powerful Aragami in God Eater 3. Wield massive God Arcs, team up with allies, and unleash devastating attacks in this fast-paced action RPG set in a post-apocalyptic world."
    ],
    [
        "name" => "Warhammer 40,000: Space Marine 2",
        "image" => "images/spacemarine.jpg",
        "price" => 2985.99,
        "desc" => "Step into the boots of a Space Marine and battle against the Tyranid hordes in Warhammer 40,000: Space Marine 2. Experience brutal, fast-paced combat in an epic war for the Imperium."
    ],
    [
        "name" => "Need for Speed Heat",
        "image" => "images/nfsheat.jpg",
        "price" => 2599.99,
        "desc" => "Race by day and risk it all by night in Need for Speed Heat. Customize your cars, evade the cops, and prove yourself in the underground street racing scene."
    ],
    [
        "name" => "One Piece: Pirate Warriors 4",
        "image" => "images/op4.jpg",
        "price" => 2899.99,
        "desc" => "Experience the thrilling adventures of Luffy and his crew in One Piece: Pirate Warriors 4. Engage in intense Musou-style battles, unleash powerful abilities, and relive iconic moments from the anime."
    ],
    [
        "name" => "Little Nightmares II",
        "image" => "images/ln2.jpg",
        "price" => 500.00,
        "desc" => "Step into a world of eerie nightmares in Little Nightmares II. Play as Mono, guided by Six, as you navigate through disturbing environments filled with twisted enemies in this thrilling suspense-adventure."
    ],
    [
        "name" => "Drug Lord Tycoon",
        "image" => "images/druglord.jpg",
        "price" => 1800.99,
        "desc" => "Build your empire from the ground up in Drug Lord Tycoon. Manage operations, expand territories, and outsmart rivals in this high-stakes strategy and business simulation game."
    ],
    [
        "name" => "Dynasty Warriors: Origins",
        "image" => "images/origins.jpg",
        "price" => 1700.99,
        "desc" => "Experience the epic battles of the Three Kingdoms like never before in Dynasty Warriors: Origins. Engage in massive hack-and-slash combat, command legendary warriors, and shape the course of history in this thrilling new installment."
    ],
    [
        "name" => "The Elder Scrolls V: Skyrim",
        "image" => "images/skyrim.jpg",
        "price" => 999.99,
        "desc" => "Embark on an epic open-world adventure in The Elder Scrolls V: Skyrim. Explore vast landscapes, battle dragons, master powerful magic, and shape your destiny in this legendary RPG."
    ],
    [
        "name" => "Bleach: Rebirth Souls",
        "image" => "images/bleach.jpg",
        "price" => 2192.99,
        "desc" => "Step into the world of Bleach in Rebirth Souls, an action-packed fighting game featuring intense battles, iconic characters, and stunning anime-style visuals. Relive legendary moments and unleash powerful Bankai attacks!"
    ],
    [
        "name" => "Mortal Kombat 11",
        "image" => "images/Mk11.jpg",
        "price" => 2199.99,
        "desc" => "Enter the brutal world of Mortal Kombat 11, featuring a cinematic story mode, new fighters, and intense battles. Master deadly combos, fatalities, and custom variations in the ultimate fighting experience."
    ],
    [
        "name" => "Wolfenstein II: The New Colossus",
        "image" => "images/stein2.jpg",
        "price" => 2199.99,
        "desc" => "Fight for freedom in Wolfenstein II: The New Colossus. Experience an action-packed narrative, intense first-person combat, and a gripping alternate-history setting as you lead the resistance against the Nazi regime."
    ],
    [
        "name" => "Resident Evil 4 Remake",
        "image" => "images/re4.jpg",
        "price" => 2199.99,
        "desc" => "Survive the horrors of Resident Evil 4 Remake, a modern reimagining of the classic survival horror masterpiece. Experience stunning visuals, redefined gameplay, and an intense story as Leon S. Kennedy fights to rescue the President's daughter."
    ],
    [
        "name" => "Hitman 3",
        "image" => "images/hitman3.jpg",
        "price" => 599.99,
        "desc" => "Step into the shoes of Agent 47 in Hitman 3, the thrilling conclusion to the World of Assassination trilogy. Plan and execute the perfect hit in vast, detailed sandbox locations with unparalleled freedom."
    ],
    [
        "name" => "Watch Dogs 2",
        "image" => "images/watchdogs2.jpg",
        "price" => 1599.99,
        "desc" => "Hack the system and fight for freedom in Watch Dogs 2. Explore the vibrant open world of San Francisco, take down corrupt corporations, and use your hacking skills to outsmart enemies."
    ],
    [
        "name" => "Dying Light 2",
        "image" => "images/dyinglight2.jpg",
        "price" => 1099.99,
        "desc" => "Survive the apocalypse in Dying Light 2. Parkour through a decaying city, battle hordes of infected, and shape the world with your choices in this thrilling open-world action RPG."
    ],
    [
        "name" => "Tom Clancy's Ghost Recon Breakpoint",
        "image" => "images/GRB.jpg",
        "price" => 2200.00,
        "desc" => "Take on the ultimate survival mission in Ghost Recon Breakpoint. Stranded on the high-tech island of Auroa, battle the rogue Wolves, adapt to brutal terrain, and use stealth, tactics, and firepower to overcome the odds in this thrilling open-world shooter."
    ],
    [
        "name" => "Terraria",
        "image" => "images/terra.jpg",
        "price" => 335.00,
        "desc" => "Dig, fight, explore, and build in Terraria. Journey through a vast, pixelated world teeming with dangerous creatures, hidden treasures, and limitless possibilities. Craft powerful gear, battle epic bosses, and shape the land as you forge your own adventure in this beloved sandbox action RPG."
    ],
    [
        "name" => "The Last of Us",
        "image" => "images/TLOU.jpg",
        "price" => 1995.00,
        "desc" => "Survive in a brutal, post-pandemic world in The Last of Us. Navigate dangerous ruins, battle infected and ruthless survivors, and experience an emotional journey of survival and sacrifice in this gripping action-adventure masterpiece."
    ],
    [
        "name" => "The Last of Us II",
        "image" => "images/TLOU II.jpg",
        "price" => 2990.00,
        "desc" => "Experience a story of revenge and redemption in The Last of Us Part II. Navigate a shattered world, face ruthless enemies, and survive brutal encounters as Ellie embarks on a relentless journey that will test her morals, emotions, and will to endure."
    ],
    [
        "name" => "Sea of Thieves",
        "image" => "images/SOT.jpg",
        "price" => 1990.00,
        "desc" => "Experience an exciting nautical journey through Sea of Thieves. Experience a massive open world while confronting enemy crews and finding buried loot to become a legendary pirate of the high seas. Dangerous beasts dwell in perilous seas yet your freedom to captain ships for battle and robbery leads you to endless tales of adventure."
    ],
    [
        "name" => "World War Z Aftermath",
        "image" => "images/WWZA.jpg",
        "price" => 1195.95,
        "desc" => "Survive the relentless undead hordes in World War Z. Team up with survivors, fight through intense co-op campaigns, and unleash devastating firepower against massive swarms of zombies."
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Games - PS5 Store</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Rajdhani:wght@400;700&family=Chakra+Petch:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>

<header>
    <div class="header-container">
        <!-- Logo -->
        <div class="logo">
            <a href="index.php">
                <img src="images/GYAT Logo.jpg" alt="PS5 Game Store Logo">
            </a>
        </div>

        <!-- Navigation -->
        <nav class="main-nav">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="buy.php">Buy Games</a></li>
                <li><a href="checkout.php">Checkout</a></li>
                <li><a href="support.php">The Creators</a></li>
            </ul>
        </nav>

        <!-- Login -->
        <div class="icon-container">
            <div class="login-icon">
                <?php if (isset($_SESSION['username'])): ?>
                    <a href="login/userinfo.php"><i class="fas fa-user-circle"></i></a>
                <?php else: ?>
                    <a href="login/register.php"><i class="fas fa-user"></i></a>
            <?php endif; ?>
        </div>

        <!-- Shopping Cart -->
        <div class="cart-icon">
            <a href="cart.php">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-count">0</span>
            </a>
        </div>
    </div>
</header>

<section class="buy-welcome">
    <h2>Choose Your Next Adventure</h2>
    <p>Browse our selection of the best PlayStation 5 games. From open-world action to thrilling multiplayer experiences, we have something for every gamer.</p>
</section>

<section class="games-list">
    <?php foreach ($games as $game): ?>
        <div class="game">
            <img src="<?php echo $game['image']; ?>" alt="<?php echo $game['name']; ?>">
            <h2><?php echo $game['name']; ?></h2>
            <p class="price">₱<?php echo number_format($game['price'], 2); ?></p>
            <p class="description"><?php echo $game['desc']; ?></p>
            <form method="post">
                <input type="hidden" name="game" value="<?php echo $game['name']; ?>">
                <input type="hidden" name="price" value="<?php echo $game['price']; ?>">
                <button type="submit" class="buy-btn">Add to Cart</button>
            </form>
        </div>
    <?php endforeach; ?>
</section>

<footer>
    <div class="footer-container">
        <div class="footer-section">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="buy.php">Buy Games</a></li>
                <li><a href="checkout.php">Checkout</a></li>
                <li><a href="support.php">The Creators</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h3>Follow Us</h3>
            <div class="social-icons">
                <a href="https://instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a>
                <a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
            </div>
        </div>

        <div class="footer-section">
            <h3>Contact</h3>
            <p>Email: support@gyathub.com</p>
            <p>Phone: +63 912 345 6789</p>
        </div>

        <div class="footer-section">
            <h3>Why Choose GYAT HUB?</h3>
            <p class="tagline"><i>"Big Selection, Bigger Savings."</i></p>
        </div>
    </div>

    <p class="footer-bottom">&copy; 2025 GYAT HUB Store. All rights reserved.</p>
</footer>

<script src="script.js"></script>
</body>
</html>