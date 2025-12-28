<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BasePokemonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('base_pokemon')->truncate();

        $pokemon = [
            // FULL GEN 1 POKÉDEX (001–151)

            ['001', 'Bulbasaur', 'Grass|Poison', 'Overgrow', 45, 49, 49, 65, 65, 45, 'Tackle', 'Growl', null, null],
            ['002', 'Ivysaur', 'Grass|Poison', 'Overgrow', 60, 62, 63, 80, 80, 60, 'Tackle', 'Growl', 'Leech Seed', null],
            ['003', 'Venusaur', 'Grass|Poison', 'Overgrow', 80, 82, 83, 100, 100, 80, 'Tackle', 'Growl', 'Leech Seed', 'Vine Whip'],

            ['004', 'Charmander', 'Fire', 'Blaze', 39, 52, 43, 60, 50, 65, 'Scratch', 'Growl', null, null],
            ['005', 'Charmeleon', 'Fire', 'Blaze', 58, 64, 58, 80, 65, 80, 'Scratch', 'Growl', 'Ember', null],
            ['006', 'Charizard', 'Fire|Flying', 'Blaze', 78, 84, 78, 109, 85, 100, 'Scratch', 'Growl', 'Ember', 'Wing Attack'],

            ['007', 'Squirtle', 'Water', 'Torrent', 44, 48, 65, 50, 64, 43, 'Tackle', 'Tail Whip', null, null],
            ['008', 'Wartortle', 'Water', 'Torrent', 59, 63, 80, 65, 80, 58, 'Tackle', 'Tail Whip', 'Water Gun', null],
            ['009', 'Blastoise', 'Water', 'Torrent', 79, 83, 100, 85, 105, 78, 'Tackle', 'Tail Whip', 'Water Gun', 'Bite'],

            ['010', 'Caterpie', 'Bug', null, 45, 30, 35, 20, 20, 45, 'Tackle', 'String Shot', null, null],
            ['011', 'Metapod', 'Bug', null, 50, 20, 55, 25, 25, 30, 'Harden', null, null, null],
            ['012', 'Butterfree', 'Bug|Flying', null, 60, 45, 50, 90, 80, 70, 'Confusion', 'Gust', 'String Shot', null],

            ['013', 'Weedle', 'Bug|Poison', null, 40, 35, 30, 20, 20, 50, 'Poison Sting', 'String Shot', null, null],
            ['014', 'Kakuna', 'Bug|Poison', null, 45, 25, 50, 25, 25, 35, 'Harden', null, null, null],
            ['015', 'Beedrill', 'Bug|Poison', null, 65, 90, 40, 45, 80, 75, 'Fury Attack', 'Twineedle', 'Focus Energy', null],

            ['016', 'Pidgey', 'Normal|Flying', null, 40, 45, 40, 35, 35, 56, 'Tackle', 'Gust', null, null],
            ['017', 'Pidgeotto', 'Normal|Flying', null, 63, 60, 55, 50, 50, 71, 'Tackle', 'Gust', 'Quick Attack', null],
            ['018', 'Pidgeot', 'Normal|Flying', null, 83, 80, 75, 70, 70, 101, 'Tackle', 'Gust', 'Quick Attack', 'Wing Attack'],

            ['019', 'Rattata', 'Normal', null, 30, 56, 35, 25, 35, 72, 'Tackle', 'Tail Whip', null, null],
            ['020', 'Raticate', 'Normal', null, 55, 81, 60, 50, 70, 97, 'Tackle', 'Tail Whip', 'Quick Attack', null],

            ['021', 'Spearow', 'Normal|Flying', null, 40, 60, 30, 31, 31, 70, 'Peck', 'Growl', null, null],
            ['022', 'Fearow', 'Normal|Flying', null, 65, 90, 65, 61, 61, 100, 'Peck', 'Growl', 'Fury Attack', null],

            ['023', 'Ekans', 'Poison', null, 35, 60, 44, 40, 54, 55, 'Wrap', 'Leer', null, null],
            ['024', 'Arbok', 'Poison', null, 60, 95, 69, 65, 79, 80, 'Wrap', 'Leer', 'Bite', null],

            ['025', 'Pikachu', 'Electric', 'Static', 35, 55, 40, 50, 50, 90, 'Thunder Shock', 'Growl', null, null],
            ['026', 'Raichu', 'Electric', 'Static', 60, 90, 55, 90, 80, 110, 'Thunder Shock', 'Growl', 'Thunderbolt', null],

            ['027', 'Sandshrew', 'Ground', null, 50, 75, 85, 20, 30, 40, 'Scratch', 'Defense Curl', null, null],
            ['028', 'Sandslash', 'Ground', null, 75, 100, 110, 45, 55, 65, 'Scratch', 'Defense Curl', 'Slash', null],

            ['029', 'Nidoran-f', 'Poison', null, 55, 47, 52, 40, 40, 41, 'Tackle', 'Growl', null, null],
            ['030', 'Nidorina', 'Poison', null, 70, 62, 67, 55, 55, 56, 'Tackle', 'Growl', 'Bite', null],
            ['031', 'Nidoqueen', 'Poison|Ground', null, 90, 92, 87, 75, 85, 76, 'Tackle', 'Growl', 'Body Slam', 'Earthquake'],

            ['032', 'Nidoran-m', 'Poison', null, 46, 57, 40, 40, 40, 50, 'Tackle', 'Leer', null, null],
            ['033', 'Nidorino', 'Poison', null, 61, 72, 57, 55, 55, 65, 'Tackle', 'Leer', 'Horn Attack', null],
            ['034', 'Nidoking', 'Poison|Ground', null, 81, 102, 77, 85, 75, 85, 'Tackle', 'Leer', 'Thrash', 'Earthquake'],

            ['035', 'Clefairy', 'Fairy', null, 70, 45, 48, 60, 65, 35, 'Pound', 'Growl', null, null],
            ['036', 'Clefable', 'Fairy', null, 95, 70, 73, 95, 90, 60, 'Pound', 'Growl', 'Body Slam', 'Moonblast'],

            ['037', 'Vulpix', 'Fire', null, 38, 41, 40, 50, 65, 65, 'Ember', 'Tail Whip', null, null],
            ['038', 'Ninetales', 'Fire', null, 73, 76, 75, 81, 100, 100, 'Ember', 'Tail Whip', 'Flamethrower', null],

            ['039', 'Jigglypuff', 'Normal|Fairy', null, 115, 45, 20, 45, 25, 20, 'Sing', 'Pound', null, null],
            ['040', 'Wigglytuff', 'Normal|Fairy', null, 140, 70, 45, 85, 50, 45, 'Sing', 'Pound', 'Body Slam', null],

            ['041', 'Zubat', 'Poison|Flying', null, 40, 45, 35, 30, 40, 55, 'Leech Life', 'Supersonic', null, null],
            ['042', 'Golbat', 'Poison|Flying', null, 75, 80, 70, 65, 75, 90, 'Leech Life', 'Supersonic', 'Bite', null],

            ['043', 'Oddish', 'Grass|Poison', null, 45, 50, 55, 75, 65, 30, 'Absorb', 'Sweet Scent', null, null],
            ['044', 'Gloom', 'Grass|Poison', null, 60, 65, 70, 85, 75, 40, 'Absorb', 'Sweet Scent', 'Poison Powder', null],
            ['045', 'Vileplume', 'Grass|Poison', null, 75, 80, 85, 110, 90, 50, 'Absorb', 'Sweet Scent', 'Petal Dance', null],

            ['046', 'Paras', 'Bug|Grass', null, 35, 70, 55, 45, 55, 25, 'Scratch', 'Stun Spore', null, null],
            ['047', 'Parasect', 'Bug|Grass', null, 60, 95, 80, 60, 80, 30, 'Scratch', 'Stun Spore', 'Slash', null],

            ['048', 'Venonat', 'Bug|Poison', null, 60, 55, 50, 40, 55, 45, 'Tackle', 'Disable', null, null],
            ['049', 'Venomoth', 'Bug|Poison', null, 70, 65, 60, 90, 75, 90, 'Tackle', 'Disable', 'Psybeam', null],

            ['050', 'Diglett', 'Ground', null, 10, 55, 25, 35, 45, 95, 'Scratch', 'Growl', null, null],
            ['051', 'Dugtrio', 'Ground', null, 35, 100, 50, 50, 70, 120, 'Scratch', 'Growl', 'Slash', null],

            ['052', 'Meowth', 'Normal', null, 40, 45, 35, 40, 40, 90, 'Scratch', 'Growl', null, null],
            ['053', 'Persian', 'Normal', null, 65, 70, 60, 65, 65, 115, 'Scratch', 'Growl', 'Slash', null],

            ['054', 'Psyduck', 'Water', null, 50, 52, 48, 65, 50, 55, 'Scratch', 'Tail Whip', null, null],
            ['055', 'Golduck', 'Water', null, 80, 82, 78, 95, 80, 85, 'Scratch', 'Tail Whip', 'Confusion', null],

            ['056', 'Mankey', 'Fighting', null, 40, 80, 35, 35, 45, 70, 'Scratch', 'Leer', null, null],
            ['057', 'Primeape', 'Fighting', null, 65, 105, 60, 60, 70, 95, 'Scratch', 'Leer', 'Karate Chop', null],

            ['058', 'Growlithe', 'Fire', null, 55, 70, 45, 70, 50, 60, 'Bite', 'Roar', null, null],
            ['059', 'Arcanine', 'Fire', null, 90, 110, 80, 100, 80, 95, 'Bite', 'Roar', 'Flamethrower', null],

            ['060', 'Poliwag', 'Water', null, 40, 50, 40, 40, 40, 90, 'Bubble', 'Hypnosis', null, null],
            ['061', 'Poliwhirl', 'Water', null, 65, 65, 65, 50, 50, 90, 'Bubble', 'Hypnosis', 'Body Slam', null],
            ['062', 'Poliwrath', 'Water|Fighting', null, 90, 95, 95, 70, 90, 70, 'Bubble', 'Hypnosis', 'Submission', null],

            ['063', 'Abra', 'Psychic', null, 25, 20, 15, 105, 55, 90, 'Teleport', null, null, null],
            ['064', 'Kadabra', 'Psychic', null, 40, 35, 30, 120, 70, 105, 'Teleport', 'Confusion', null, null],
            ['065', 'Alakazam', 'Psychic', null, 55, 50, 45, 135, 95, 120, 'Teleport', 'Confusion', 'Psychic', null],

            ['066', 'Machop', 'Fighting', null, 70, 80, 50, 35, 35, 35, 'Karate Chop', 'Leer', null, null],
            ['067', 'Machoke', 'Fighting', null, 80, 100, 70, 50, 60, 45, 'Karate Chop', 'Leer', 'Low Kick', null],
            ['068', 'Machamp', 'Fighting', null, 90, 130, 80, 65, 85, 55, 'Karate Chop', 'Leer', 'Submission', null],

            ['069', 'Bellsprout', 'Grass|Poison', null, 50, 75, 35, 70, 30, 40, 'Vine Whip', 'Growth', null, null],
            ['070', 'Weepinbell', 'Grass|Poison', null, 65, 90, 50, 85, 45, 55, 'Vine Whip', 'Growth', 'Poison Powder', null],
            ['071', 'Victreebel', 'Grass|Poison', null, 80, 105, 65, 100, 70, 70, 'Vine Whip', 'Growth', 'Razor Leaf', null],

            ['072', 'Tentacool', 'Water|Poison', null, 40, 40, 35, 50, 100, 70, 'Poison Sting', 'Supersonic', null, null],
            ['073', 'Tentacruel', 'Water|Poison', null, 80, 70, 65, 80, 120, 100, 'Poison Sting', 'Supersonic', 'Wrap', null],

            ['074', 'Geodude', 'Rock|Ground', null, 40, 80, 100, 30, 30, 20, 'Tackle', 'Defense Curl', null, null],
            ['075', 'Graveler', 'Rock|Ground', null, 55, 95, 115, 45, 45, 35, 'Tackle', 'Defense Curl', 'Rock Throw', null],
            ['076', 'Golem', 'Rock|Ground', null, 80, 120, 130, 55, 65, 45, 'Tackle', 'Defense Curl', 'Earthquake', null],

            ['077', 'Ponyta', 'Fire', null, 50, 85, 55, 65, 65, 90, 'Ember', 'Tail Whip', null, null],
            ['078', 'Rapidash', 'Fire', null, 65, 100, 70, 80, 80, 105, 'Ember', 'Tail Whip', 'Fire Spin', null],

            ['079', 'Slowpoke', 'Water|Psychic', null, 90, 65, 65, 40, 40, 15, 'Tackle', 'Growl', null, null],
            ['080', 'Slowbro', 'Water|Psychic', null, 95, 75, 110, 100, 80, 30, 'Tackle', 'Growl', 'Confusion', null],

            ['081', 'Magnemite', 'Electric|Steel', null, 25, 35, 70, 95, 55, 45, 'Tackle', 'Thunder Shock', null, null],
            ['082', 'Magneton', 'Electric|Steel', null, 50, 60, 95, 120, 70, 70, 'Tackle', 'Thunder Shock', 'Sonic Boom', null],

            ['083', 'Farfetchd', 'Normal|Flying', null, 52, 90, 55, 58, 62, 60, 'Peck', 'Sand Attack', null, null],

            ['084', 'Doduo', 'Normal|Flying', null, 35, 85, 45, 35, 35, 75, 'Peck', 'Growl', null, null],
            ['085', 'Dodrio', 'Normal|Flying', null, 60, 110, 70, 60, 60, 110, 'Peck', 'Growl', 'Drill Peck', null],

            ['086', 'Seel', 'Water', null, 65, 45, 55, 45, 70, 45, 'Headbutt', 'Growl', null, null],
            ['087', 'Dewgong', 'Water|Ice', null, 90, 70, 80, 70, 95, 70, 'Headbutt', 'Growl', 'Aurora Beam', null],

            ['088', 'Grimer', 'Poison', null, 80, 80, 50, 40, 50, 25, 'Pound', 'Disable', null, null],
            ['089', 'Muk', 'Poison', null, 105, 105, 75, 65, 100, 50, 'Pound', 'Disable', 'Sludge', null],

            ['090', 'Shellder', 'Water', null, 30, 65, 100, 45, 25, 40, 'Tackle', 'Withdraw', null, null],
            ['091', 'Cloyster', 'Water|Ice', null, 50, 95, 180, 85, 45, 70, 'Tackle', 'Withdraw', 'Clamp', null],

            ['092', 'Gastly', 'Ghost|Poison', null, 30, 35, 30, 100, 35, 80, 'Lick', 'Confuse Ray', null, null],
            ['093', 'Haunter', 'Ghost|Poison', null, 45, 50, 45, 115, 55, 95, 'Lick', 'Confuse Ray', 'Night Shade', null],
            ['094', 'Gengar', 'Ghost|Poison', null, 60, 65, 60, 130, 75, 110, 'Lick', 'Confuse Ray', 'Shadow Ball', null],

            ['095', 'Onix', 'Rock|Ground', null, 35, 45, 160, 30, 45, 70, 'Tackle', 'Harden', null, null],

            ['096', 'Drowzee', 'Psychic', null, 60, 48, 45, 43, 90, 42, 'Pound', 'Hypnosis', null, null],
            ['097', 'Hypno', 'Psychic', null, 85, 73, 70, 73, 115, 67, 'Pound', 'Hypnosis', 'Confusion', null],

            ['098', 'Krabby', 'Water', null, 30, 105, 90, 25, 25, 50, 'Bubble', 'Leer', null, null],
            ['099', 'Kingler', 'Water', null, 55, 130, 115, 50, 50, 75, 'Bubble', 'Leer', 'Crabhammer', null],

            ['100', 'Voltorb', 'Electric', null, 40, 30, 50, 55, 55, 100, 'Tackle', 'Screech', null, null],
            ['101', 'Electrode', 'Electric', null, 60, 50, 70, 80, 80, 140, 'Tackle', 'Screech', 'Thunderbolt', null],

            ['102', 'Exeggcute', 'Grass|Psychic', null, 60, 40, 80, 60, 45, 40, 'Barrage', 'Hypnosis', null, null],
            ['103', 'Exeggutor', 'Grass|Psychic', null, 95, 95, 85, 125, 65, 55, 'Barrage', 'Hypnosis', 'Psychic', null],

            ['104', 'Cubone', 'Ground', null, 50, 50, 95, 40, 50, 35, 'Bone Club', 'Growl', null, null],
            ['105', 'Marowak', 'Ground', null, 60, 80, 110, 50, 80, 45, 'Bone Club', 'Growl', 'Bonemerang', null],

            ['106', 'Hitmonlee', 'Fighting', null, 50, 120, 53, 35, 110, 87, 'Double Kick', 'Meditate', null, null],
            ['107', 'Hitmonchan', 'Fighting', null, 50, 105, 79, 35, 110, 76, 'Comet Punch', 'Agility', null, null],

            ['108', 'Lickitung', 'Normal', null, 90, 55, 75, 60, 75, 30, 'Lick', 'Supersonic', null, null],

            ['109', 'Koffing', 'Poison', null, 40, 65, 95, 60, 45, 35, 'Tackle', 'Smog', null, null],
            ['110', 'Weezing', 'Poison', null, 65, 90, 120, 85, 70, 60, 'Tackle', 'Smog', 'Sludge', null],

            ['111', 'Rhyhorn', 'Ground|Rock', null, 80, 85, 95, 30, 30, 25, 'Horn Attack', 'Tail Whip', null, null],
            ['112', 'Rhydon', 'Ground|Rock', null, 105, 130, 120, 45, 45, 40, 'Horn Attack', 'Tail Whip', 'Earthquake', null],

            ['113', 'Chansey', 'Normal', null, 250, 5, 5, 35, 105, 50, 'Pound', 'Growl', null, null],

            ['114', 'Tangela', 'Grass', null, 65, 55, 115, 100, 40, 60, 'Vine Whip', 'Bind', null, null],

            ['115', 'Kangaskhan', 'Normal', null, 105, 95, 80, 40, 80, 90, 'Comet Punch', 'Bite', null, null],

            ['116', 'Horsea', 'Water', null, 30, 40, 70, 70, 25, 60, 'Bubble', 'Smokescreen', null, null],
            ['117', 'Seadra', 'Water', null, 55, 65, 95, 95, 45, 85, 'Bubble', 'Smokescreen', 'Water Gun', null],

            ['118', 'Goldeen', 'Water', null, 45, 67, 60, 35, 50, 63, 'Peck', 'Tail Whip', null, null],
            ['119', 'Seaking', 'Water', null, 80, 92, 65, 65, 80, 68, 'Peck', 'Tail Whip', 'Horn Attack', null],

            ['120', 'Staryu', 'Water', null, 30, 45, 55, 70, 55, 85, 'Tackle', 'Water Gun', null, null],
            ['121', 'Starmie', 'Water|Psychic', null, 60, 75, 85, 100, 85, 115, 'Tackle', 'Water Gun', 'Recover', null],

            ['122', 'Mr-Mime', 'Psychic|Fairy', null, 40, 45, 65, 100, 120, 90, 'Confusion', 'Barrier', null, null],

            ['123', 'Scyther', 'Bug|Flying', null, 70, 110, 80, 55, 80, 105, 'Quick Attack', 'Leer', null, null],

            ['124', 'Jynx', 'Ice|Psychic', null, 65, 50, 35, 115, 95, 95, 'Pound', 'Lovely Kiss', null, null],

            ['125', 'Electabuzz', 'Electric', null, 65, 83, 57, 95, 85, 105, 'Quick Attack', 'Thunder Shock', null, null],

            ['126', 'Magmar', 'Fire', null, 65, 95, 57, 100, 85, 93, 'Ember', 'Smokescreen', null, null],

            ['127', 'Pinsir', 'Bug', null, 65, 125, 100, 55, 70, 85, 'Vice Grip', 'Harden', null, null],

            ['128', 'Tauros', 'Normal', null, 75, 100, 95, 40, 70, 110, 'Tackle', 'Tail Whip', null, null],

            ['129', 'Magikarp', 'Water', null, 20, 10, 55, 15, 20, 80, 'Splash', null, null, null],
            ['130', 'Gyarados', 'Water|Flying', null, 95, 125, 79, 60, 100, 81, 'Bite', 'Leer', 'Hydro Pump', null],

            ['131', 'Lapras', 'Water|Ice', null, 130, 85, 80, 85, 95, 60, 'Water Gun', 'Growl', null, null],

            ['132', 'Ditto', 'Normal', null, 48, 48, 48, 48, 48, 48, 'Transform', null, null, null],

            ['133', 'Eevee', 'Normal', null, 55, 55, 50, 45, 65, 55, 'Tackle', 'Tail Whip', null, null],
            ['134', 'Vaporeon', 'Water', null, 130, 65, 60, 110, 95, 65, 'Water Gun', 'Tail Whip', null, null],
            ['135', 'Jolteon', 'Electric', null, 65, 65, 60, 110, 95, 130, 'Thunder Shock', 'Tail Whip', null, null],
            ['136', 'Flareon', 'Fire', null, 65, 130, 60, 95, 110, 65, 'Ember', 'Tail Whip', null, null],

            ['137', 'Porygon', 'Normal', null, 65, 60, 70, 85, 75, 40, 'Tackle', 'Sharpen', null, null],

            ['138', 'Omanyte', 'Rock|Water', null, 35, 40, 100, 90, 55, 35, 'Water Gun', 'Withdraw', null, null],
            ['139', 'Omastar', 'Rock|Water', null, 70, 60, 125, 115, 70, 55, 'Water Gun', 'Withdraw', 'Spike Cannon', null],

            ['140', 'Kabuto', 'Rock|Water', null, 30, 80, 90, 55, 45, 55, 'Scratch', 'Harden', null, null],
            ['141', 'Kabutops', 'Rock|Water', null, 60, 115, 105, 65, 70, 80, 'Scratch', 'Harden', 'Slash', null],

            ['142', 'Aerodactyl', 'Rock|Flying', null, 80, 105, 65, 60, 75, 130, 'Wing Attack', 'Agility', null, null],

            ['143', 'Snorlax', 'Normal', null, 160, 110, 65, 65, 110, 30, 'Tackle', 'Amnesia', null, null],

            ['144', 'Articuno', 'Ice|Flying', null, 90, 85, 100, 95, 125, 85, 'Gust', 'Ice Beam', null, null],
            ['145', 'Zapdos', 'Electric|Flying', null, 90, 90, 85, 125, 90, 100, 'Peck', 'Thunder Shock', null, null],
            ['146', 'Moltres', 'Fire|Flying', null, 90, 100, 90, 125, 85, 90, 'Gust', 'Ember', null, null],

            ['147', 'Dratini', 'Dragon', null, 41, 64, 45, 50, 50, 50, 'Wrap', 'Leer', null, null],
            ['148', 'Dragonair', 'Dragon', null, 61, 84, 65, 70, 70, 70, 'Wrap', 'Leer', 'Thunder Wave', null],
            ['149', 'Dragonite', 'Dragon|Flying', null, 91, 134, 95, 100, 100, 80, 'Wrap', 'Leer', 'Hyper Beam', null],

            ['150', 'Mewtwo', 'Psychic', null, 106, 110, 90, 154, 90, 130, 'Confusion', 'Disable', null, null],
            ['151', 'Mew', 'Psychic', null, 100, 100, 100, 100, 100, 100, 'Pound', 'Transform', null, null],
        ];

        $rows = [];
        $descriptions = [
            '001' => 'A strange seed was planted on its back at birth. The plant sprouts and grows with this Pokémon.',
            '002' => 'When the bulb on its back grows large, it appears to lose the ability to stand on its hind legs.',
            '003' => 'The plant blooms when it is absorbing solar energy. It stays on the move to seek sunlight.',

            '004' => 'Obviously prefers hot places. When it rains, steam is said to spout from the tip of its tail.',
            '005' => 'When it swings its burning tail, it elevates the temperature to unbearably high levels.',
            '006' => 'Spits fire that is hot enough to melt boulders. Known to cause forest fires unintentionally.',

            '007' => 'After birth, its back swells and hardens into a shell. Powerfully sprays foam from its mouth.',
            '008' => 'Often hides in water to stalk unwary prey. For swimming fast, it moves its ears to maintain balance.',
            '009' => 'A brutal Pokémon with pressurized water jets on its shell. They are used for high speed tackles.',

            '010' => 'Its short feet are tipped with suction pads that enable it to tirelessly climb slopes and walls.',
            '011' => 'This Pokémon is vulnerable to attack while its shell is soft, exposing its weak and tender body.',
            '012' => 'In battle, it flaps its wings at high speed to release highly toxic dust into the air.',

            '013' => 'Often found in forests, eating leaves. It has a sharp venomous stinger on its head.',
            '014' => 'Almost incapable of moving, this Pokémon can only harden its shell to protect itself.',
            '015' => 'Flies at high speed and attacks using its large venomous stingers on its forelegs and tail.',

            '016' => 'A common sight in forests and woods. It flaps its wings at ground level to kick up blinding sand.',
            '017' => 'Very protective of its sprawling territorial area, this Pokémon will fiercely peck at intruders.',
            '018' => 'When hunting, it skims the surface of water at high speed to pick off unwary prey.',

            '019' => 'Bites anything when it attacks. Small and very quick, it is a common sight in many places.',
            '020' => 'It uses its whiskers to maintain its balance. It seems to slow down if they are cut off.',

            '021' => 'Eats bugs in grassy areas. It has to flap its short wings at high speed to stay airborne.',
            '022' => 'With its huge and magnificent wings, it can keep aloft without ever having to land for rest.',

            '023' => 'Moves silently and stealthily. Eats the eggs of birds, such as Pidgey and Spearow, whole.',
            '024' => 'It is rumored that the ferocious warning markings on its belly differ from area to area.',

            '025' => 'When several of these Pokémon gather, their electricity could build and cause lightning storms.',
            '026' => 'Its long tail serves as a ground to protect itself from its own high-voltage power.',

            '027' => 'Burrows deep underground in arid locations far from water. It only emerges to hunt for food.',
            '028' => 'Curls up into a spiny ball when threatened. It can roll while curled up to attack or escape.',

            '029' => 'Although small, its venomous barbs render this Pokémon dangerous. The female has smaller horns.',
            '030' => 'The female\'s horn develops slowly. Prefers physical attacks such as clawing and biting.',
            '031' => 'Its hard scales provide strong protection. It uses its hefty bulk to execute powerful moves.',

            '032' => 'Stiffens its ears to sense danger. The larger its horns, the more powerful its secreted venom.',
            '033' => 'An aggressive Pokémon that is quick to attack. The horn on its head secretes a powerful venom.',
            '034' => 'It uses its powerful tail in battle to smash, constrict, then break the prey\'s bones.',

            '035' => 'Its magical and cute appeal has many admirers. It is rare and found only in certain areas.',
            '036' => 'A timid fairy Pokémon that is rarely seen. It will run and hide the moment it senses people.',

            '037' => 'At the time of birth, it has just one tail. The tail splits from its tip as it grows older.',
            '038' => 'Very smart and very vengeful. Grabbing one of its many tails could result in a 1000-year curse.',

            '039' => 'When its huge eyes light up, it sings a mysteriously soothing melody that lulls its enemies to sleep.',
            '040' => 'The body is soft and rubbery. When angered, it will suck in air and inflate itself to an enormous size.',

            '041' => 'Forms colonies in perpetually dark places. Uses ultrasonic waves to identify and approach targets.',
            '042' => 'Once it strikes, it will not stop draining energy from the victim even if it gets too heavy to fly.',

            '043' => 'During the day, it keeps its face buried in the ground. At night, it wanders around sowing seeds.',
            '044' => 'The fluid that oozes from its mouth isn\'t drool. It is a nectar that is used to attract prey.',
            '045' => 'The larger its petals, the more toxic pollen it contains. Its big head is heavy and hard to hold up.',

            '046' => 'Burrows to suck tree roots. The mushrooms on its back grow by drawing nutrients from the bug host.',
            '047' => 'A host-parasite pair in which the parasite mushroom has taken over the host bug.',

            '048' => 'Lives in the shadows of tall trees where it eats insects. It is attracted by light at night.',
            '049' => 'The dust-like scales covering its wings are color coded to indicate the kinds of poison it has.',

            '050' => 'Lives about one yard underground where it feeds on plant roots. It sometimes appears above ground.',
            '051' => 'A team of Diglett triplets. It triggers huge earthquakes by burrowing 60 miles underground.',

            '052' => 'Adores circular objects. Wanders the streets on a nightly basis to look for dropped loose change.',
            '053' => 'Although its fur has many admirers, it is tough to raise as a pet because of its fickle meanness.',

            '054' => 'While lulling its enemies with its vacant look, this wily Pokémon will use psychokinetic powers.',
            '055' => 'Often seen swimming elegantly by lakeshores. It is often mistaken for the Japanese monster Kappa.',

            '056' => 'Extremely quick to anger. It could be docile one moment then thrashing away the next instant.',
            '057' => 'Always furious and tenacious to boot. It will not abandon chasing its quarry until it is caught.',

            '058' => 'Very protective of its territory. It will bark and bite to repel intruders from its space.',
            '059' => 'A Pokémon that has been admired since the past for its beauty. It runs agilely as if on wings.',

            '060' => 'Its newly grown legs prevent it from running. It appears to prefer swimming than trying to stand.',
            '061' => 'Capable of living in or out of water. When out of water, it sweats to keep its body slimy.',
            '062' => 'An adept swimmer at both the front crawl and breaststroke. Easily overtakes the best human swimmers.',

            '063' => 'Using its ability to read minds, it will sense impending danger and teleport to safety.',
            '064' => 'It emits special alpha waves from its body that induce headaches just by being close by.',
            '065' => 'Its brain can outperform a supercomputer. Its intelligence quotient is said to be 5000.',

            '066' => 'Loves to build its muscles. It trains in all styles of martial arts to become even stronger.',
            '067' => 'Its muscular body is so powerful, it must wear a power-save belt to regulate its motions.',
            '068' => 'Using its heavy muscles, it throws powerful punches that can send the victim clear over the horizon.',

            '069' => 'A carnivorous Pokémon that traps and eats bugs. It uses its root feet to soak up needed moisture.',
            '070' => 'It spits out poisonpowder to immobilize the enemy and then finishes it with a spray of acid.',
            '071' => 'Said to live in huge colonies deep in jungles, although no one has ever returned from there.',

            '072' => 'Drifts in shallow seas. Anglers who hook them by accident are often punished by its stinging acid.',
            '073' => 'The tentacles are normally kept short. On hunts, they are extended to ensnare and immobilize prey.',

            '074' => 'Found in fields and mountains. Mistaking them for boulders, people often step or trip on them.',
            '075' => 'Rolls down slopes to move. It rolls over any obstacle without slowing or changing its direction.',
            '076' => 'Its boulder-like body is extremely hard. It can easily withstand dynamite blasts without damage.',

            '077' => 'Its hooves are 10 times harder than diamonds. It can trample anything completely flat.',
            '078' => 'Very competitive, this Pokémon will chase anything that moves fast in the hopes of racing it.',

            '079' => 'Incredibly slow and dopey. It takes 5 seconds for it to feel pain when under attack.',
            '080' => 'The Shellder that is latched onto Slowpoke\'s tail is said to feed on the host\'s left over scraps.',

            '081' => 'Uses anti-gravity to stay suspended. Appears without warning and uses Thunder Wave and similar moves.',
            '082' => 'Formed by several Magnemite linked together. They frequently appear when sunspots flare.',

            '083' => 'The sprig of green onions it holds is its weapon. It is used much like a metal sword.',
            '084' => 'A bird that makes up for its poor flying with its fast foot speed. Leaves giant footprints.',
            '085' => 'Uses its three brains to execute complex plans. While two heads sleep, one head stays awake.',

            '086' => 'The protruding horn on its head is very hard. It is used for bashing through thick ice.',
            '087' => 'Stores thermal energy in its body. Swims at a steady 8 knots even in intensely cold waters.',

            '088' => 'Appears in filthy areas. Thrives by sucking up polluted sludge that is pumped out of factories.',
            '089' => 'Thickly covered with a filthy, vile sludge. It is so toxic, even its footprints contain poison.',

            '090' => 'Its hard shell repels any kind of attack. It is vulnerable only when its shell is open.',
            '091' => 'When attacked, it launches its horns in quick volleys. Its innards have never been seen.',

            '092' => 'Almost invisible, this gaseous Pokémon cloaks the target and puts it to sleep without notice.',
            '093' => 'Because of its ability to slip through block walls, it is said to be from another dimension.',
            '094' => 'Under a full moon, this Pokémon likes to mimic the shadows of people and laugh at their fright.',

            '095' => 'As it grows, the stone portions of its body harden to become similar to a diamond, but colored black.',
            '096' => 'Puts enemies to sleep then eats their dreams. Occasionally gets sick from eating bad dreams.',
            '097' => 'When it locks eyes with an enemy, it will use a mix of PSI moves such as Hypnosis and Confusion.',

            '098' => 'Its pincers are not only powerful weapons, they are used for balance when walking sideways.',
            '099' => 'The large pincer has 10000 hp of crushing power. However, its huge size makes it unwieldy.',

            '100' => 'Usually found in power plants. Easily mistaken for a Poké Ball, they have zapped many people.',
            '101' => 'It stores electric energy under very high pressure. It often explodes with little or no provocation.',

            '102' => 'Often mistaken for eggs. When disturbed, they quickly gather and attack in swarms.',
            '103' => 'Legend has it that on rare occasions, one of its heads will drop off and continue on as an Exeggcute.',

            '104' => 'Because it never removes its skull helmet, no one has ever seen this Pokémon\'s real face.',
            '105' => 'The bone it holds is its key weapon. It throws the bone skillfully like a boomerang.',

            '106' => 'When in a hurry, its legs lengthen progressively. It runs smoothly with extra long, loping strides.',
            '107' => 'While apparently doing nothing, it fires punches in lightning-fast volleys that are impossible to see.',

            '108' => 'Its tongue can be extended like a chameleon\'s. It leaves a tingling sensation when it licks enemies.',
            '109' => 'Because it stores several kinds of toxic gases in its body, it is prone to exploding without warning.',
            '110' => 'Where two kinds of poison gases meet, 2 Koffing can fuse into a Weezing over many years.',

            '111' => 'Its massive bones are 1000 times harder than human bones. It can easily knock a trailer flying.',
            '112' => 'Protected by an armor-like hide, it is capable of living in molten lava of 3600 degrees.',

            '113' => 'A rare and elusive Pokémon that is said to bring happiness to those who manage to get it.',
            '114' => 'The whole body is swathed with wide vines that are similar to seaweed. Its vines shake as it walks.',

            '115' => 'The infant rarely ventures out of its mother\'s protective pouch until it is 3 years old.',
            '116' => 'Known to shoot down flying bugs with precision blasts of ink from the surface of the water.',
            '117' => 'Capable of swimming backwards by rapidly flapping its wing-like pectoral fins.',

            '118' => 'Its tail fin billows like an elegant ballroom dress, giving it the nickname of the Water Queen.',
            '119' => 'In the autumn spawning season, they can be seen swimming powerfully up rivers and creeks.',

            '120' => 'An enigmatic Pokémon that can effortlessly regenerate any appendage it loses in battle.',
            '121' => 'Its central core glows with the seven colors of the rainbow. Some people value the core as a gem.',

            '122' => 'If interrupted while it is miming, it will slap around the offender with its broad hands.',
            '123' => 'With ninja-like agility and speed, it can create the illusion that there is more than one.',
            '124' => 'It seductively wiggles its hips as it walks. It can cause people to dance in unison with it.',

            '125' => 'Normally found near power plants, they can wander away and cause major blackouts in cities.',
            '126' => 'Its body always burns with an orange glow that enables it to hide perfectly among flames.',
            '127' => 'If it fails to crush the victim in its pincers, it will swing it around and toss it hard.',

            '128' => 'When it targets an enemy, it charges furiously while whipping its body with its long tails.',
            '129' => 'In the distant past, it was somewhat stronger than the horribly weak descendants that exist today.',
            '130' => 'Rarely seen in the wild. Huge and vicious, it is capable of destroying entire cities in a rage.',

            '131' => 'A Pokémon that has been overhunted almost to extinction. It can ferry people across water.',
            '132' => 'Capable of copying an enemy\'s genetic code to instantly transform itself into a duplicate.',
            '133' => 'Its genetic code is irregular. It may mutate if it is exposed to radiation from element stones.',

            '134' => 'Lives close to water. Its long tail is ridged with a fin which is often mistaken for a mermaid\'s.',
            '135' => 'It accumulates negative ions in the atmosphere to blast out 10000-volt lightning bolts.',
            '136' => 'When storing thermal energy in its body, its temperature could soar to over 1600 degrees.',

            '137' => 'A Pokémon that consists entirely of programming code. Capable of moving freely in cyberspace.',
            '138' => 'Although long extinct, in rare cases, it can be genetically resurrected from fossils.',
            '139' => 'A prehistoric Pokémon that died out when its heavy shell made it unable to catch prey.',

            '140' => 'A Pokémon that was resurrected from a fossil. It uses the eyes on its back while hiding on the seabed.',
            '141' => 'Its sleek shape is perfect for swimming. It slashes prey with its claws and drains the body fluids.',

            '142' => 'A ferocious, prehistoric Pokémon that goes for the enemy\'s throat with its serrated saw-like fangs.',
            '143' => 'Very lazy. Just eats and sleeps. As its rotund bulk builds, it becomes steadily more slothful.',

            '144' => 'A legendary bird Pokémon that is said to appear to doomed people who are lost in icy mountains.',
            '145' => 'A legendary bird Pokémon that is said to appear from clouds while dropping enormous lightning bolts.',
            '146' => 'Known as the legendary bird of fire. Every flap of its wings creates a dazzling flash of flames.',

            '147' => 'Long considered a mythical Pokémon until recently when a small colony was found living underwater.',
            '148' => 'A mystical Pokémon that exudes a gentle aura. Has the ability to change climate conditions.',
            '149' => 'An extremely rarely seen marine Pokémon. Its intelligence is said to match that of humans.',

            '150' => 'It was created by a scientist after years of horrific gene splicing and DNA engineering experiments.',
            '151' => 'So rare that it is still said to be a mirage by many experts. Only a few people have seen it worldwide.',
        ];

        foreach ($pokemon as $p) {
            [$id, $name, $type, $ability, $hp, $atk, $def, $spa, $spd, $spe, $m1, $m2, $m3, $m4] = $p;

            $rows[] = [
                'pokedex_id' => $id,
                'name' => $name,
                'type' => $type,
                'base_abilities' => $ability,
                'min_hp' => $hp,
                'max_hp' => $hp,
                'min_attack' => $atk,
                'max_attack' => $atk,
                'min_defense' => $def,
                'max_defense' => $def,
                'min_special_attack' => $spa,
                'max_special_attack' => $spa,
                'min_special_defense' => $spd,
                'max_special_defense' => $spd,
                'min_speed' => $spe,
                'max_speed' => $spe,
                'base_move1' => $m1,
                'base_move2' => $m2,
                'base_move3' => $m3,
                'base_move4' => $m4,
                'sprite_url' => "https://img.pokemondb.net/sprites/red-blue/normal/" . strtolower($name) . ".png",
                'description' => $descriptions[$id] ?? 'This Pokémon is native to the Kanto region and has distinct traits and battle capabilities.',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('base_pokemon')->insert($rows);
    }
}
