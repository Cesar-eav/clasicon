<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { faSignInAlt, faUserPlus, faCompass, faTachometerAlt, faUser, faSyncAlt } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { ref } from 'vue'

// Definimos las propiedades que puede recibir el componente
defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    auth: Object // Propiedad para manejar la autenticación del usuario
})

// Imagen de fondo y otros recursos
const backgroundImage = "https://images.unsplash.com/photo-1582134534988-f8bcfc928273?q=80&w=1496&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"; // Cambia por una URL de imagen real


// Datos simulados de recomendaciones

const recommendations = ref([
    {
        user: 'Thomas Mann',
        title: 'Effi Briest',
        category: 'libro',
        description: 'Si se quisiera seleccionar con el máximo rigor una biblioteca compuesta de doce novelas -o de diez, o incluso de seis-, no podría de ningún modo omitirse Effi Briest',
        image: '/storage/images/libros/effi_briest.webp',
    },
    {
        user: 'Carlos Pérez',
        title: 'Inception',
        category: 'película',
        description: 'Esta película sin duda es una explosión de cosas que te dejan con la boca abierta y la tienes que ver 2 o mas veces para entender de principio a fin.',
        image: '/storage/images/peliculas/inception.jpg',
    },
    {
        user: 'María González',
        title: 'El Padrino',
        category: 'película',
        description: 'Una obra maestra cinematográfica sobre el poder, la familia y la corrupción.',
        image: '/storage/images/peliculas/Elpadrino.webp',
    },
    {
        user: 'Juan Ramírez',
        title: '1984',
        category: 'libro',
        description: 'Una obra maestra sobre la rebelión y la opresión, donde la guerra es paz.',
        image: '/storage/images/libros/1984.webp',
    },
    {
        user: 'Ana Martínez',
        title: 'Breaking Bad',
        category: 'serie',
        description: 'Una serie que redefine el drama televisivo con personajes complejos y tramas intensas.',
        image: '/storage/images/peliculas/Breaking_bad_season5.webp',
    },
    {
        user: 'Luis Fernández',
        title: 'Stranger Things',
        category: 'serie',
        description: 'Una oda a los 80s con personajes geniales. Es como volver al pasado y recordar cuando no había internet y teniamos que salir a la calle a jugar.',
        image: '/storage/images/peliculas/strangerthiks.jpg',
    },

    {
        user: 'Luis Andrade',
        title: 'Green Street Hooligans',
        category: 'película',
        description: 'Me dejó loco esta película. Es el arte de crear una película con una trama simple y buena. GSH 2 es una chet, pero esta es muy buena película. Es ver a Frodo agarrandose a combos.',
        image: '/storage/images/peliculas/green_street_holligans.jpg',
    },
    {
        user: 'Loreto Lefenda',
        title: 'La Física del Futuro',
        category: 'libro',
        description: 'Es un viaje a pontenciales futuros que parecen ciencia ficcion pero es con tecnología que se está desarrollando y entrevista a sus creadores. Lo compré porque el autor afirma que los que hablan sobre la tecnología son siempre sociologos o historiadores cuando en realidad no saben de la tecnologia.',
        image: '/storage/images/libros/lafisicadelfuturo.webp',
    },
    {
        user: 'Manuel Canales',
        title: 'Worms',
        category: 'game',
        description: 'Llego jugando este juego por 20 años. El Worms Armágedon es imbatible.',
        image: '/storage/images/games/worms.jpg',
    },
    {
        user: 'Daniel Castro',
        title: 'Toy Soldiers',
        category: 'game',
        description: 'Juego de estrategia enviciante. Ojalá sacaran más misiones. ',
        image: '/storage/images/games/toysoldier.jpeg',
    },
    {
        user: 'Mark Times',
        title: 'Hábitos atómicos',
        category: 'libro',
        description: 'Paso a paso, cambiará tu rutina.',
        image: '/storage/images/libros/portada_habitos-atomicos_james-clear_202002111200.webp',
    },
    {
        user: 'Laura González',
        title: 'Cien Años de Soledad',
        category: 'libro',
        description: '¡Este libro es pura magia! La historia de la familia Buendía te atrapa desde la primera página. No sé cómo lo hace García Márquez, pero sientes que estás en Macondo. ¡Tienes que leerlo!',
        image: '/storage/images/libros/cien_anos_de_soledad.webp',
    },
    {
        user: 'José Hernández',
        title: 'El Principito',
        category: 'libro',
        description: 'Un clásico que no importa cuántas veces lo leas, siempre encuentras algo nuevo. Es un libro que te hace reflexionar sobre lo que realmente importa en la vida.',
        image: '/storage/images/libros/el_principito.webp',
    },
    {
        user: 'Sofía Ramírez',
        title: 'Los Detectives Salvajes',
        category: 'libro',
        description: 'Roberto Bolaño es un genio. Esta novela es como una aventura literaria con personajes inolvidables. No vas a querer soltarlo.',
        image: '/storage/images/libros/los_detectives_salvajes.webp',
    },
    {
        user: 'Alberto Martínez',
        title: 'Sapiens',
        category: 'libro',
        description: '¡Este libro te hace ver la historia de la humanidad desde una perspectiva completamente nueva! Es fascinante cómo Yuval Noah Harari conecta todo.',
        image: '/storage/images/libros/sapiens.webp',
    },
    {
        user: 'Claudia Pérez',
        title: 'Matar a un Ruiseñor',
        category: 'libro',
        description: 'Una historia poderosa sobre justicia y prejuicio. Scout Finch es un personaje que se queda contigo para siempre.',
        image: '/storage/images/libros/matar_a_un_ruiseñor.webp',
    },
    {
        user: 'Juan López',
        title: 'El Nombre del Viento',
        category: 'libro',
        description: 'Este libro es pura magia, literalmente. Kvothe es uno de esos personajes que te dan ganas de saber más y más. ¡No puedo esperar para leer la secuela!',
        image: '/storage/images/libros/el_nombre_del_viento.webp',
    },
    {
        user: 'Marta Delgado',
        title: 'Rayuela',
        category: 'libro',
        description: 'Cortázar juega con la mente del lector de una manera increíble. Es un libro que puedes leer de varias formas y siempre será una experiencia distinta.',
        image: '/storage/images/libros/rayuela.webp',
    },
    {
        user: 'Pablo Torres',
        title: '1984',
        category: 'libro',
        description: 'Este libro es tan relevante hoy como cuando se escribió. Te hace cuestionar todo lo que das por sentado sobre la libertad y la privacidad.',
        image: '/storage/images/libros/1984.webp',
    },
    {
        user: 'Lucía Rivera',
        title: 'La Sombra del Viento',
        category: 'libro',
        description: 'Este libro es como una carta de amor a los libros. Barcelona nunca se sintió tan misteriosa y encantadora.',
        image: '/storage/images/libros/la_sombra_del_viento.webp',
    },
    {
        user: 'Carlos Fernández',
        title: 'El Hombre en Busca de Sentido',
        category: 'libro',
        description: 'Es uno de esos libros que te cambian la vida. Viktor Frankl cuenta su experiencia en los campos de concentración y te deja una lección de vida increíble.',
        image: '/storage/images/libros/el_hombre_en_busca_de_sentido.webp',
    },

    {
        user: 'María González',
        title: 'Forrest Gump',
        category: 'película',
        description: '¡Esta película es un viaje! Forrest te lleva por todos los momentos importantes del siglo XX, y no puedes evitar amarlo por su inocencia y sabiduría.',
        image: '/storage/images/peliculas/forrest_gump.webp',
    },
    {
        user: 'Daniel Sánchez',
        title: 'El Señor de los Anillos: La Comunidad del Anillo',
        category: 'película',
        description: 'Es el comienzo de una aventura épica. La Tierra Media cobra vida en esta película de una manera impresionante. ¡Te va a encantar!',
        image: '/storage/images/peliculas/el_senor_de_los_anillos_la_comunidad.jpg',
    },
    {
        user: 'Ana Pérez',
        title: 'Matrix',
        category: 'película',
        description: 'Te va a volar la cabeza. Esta película redefine lo que significa la realidad. Los efectos especiales y la historia son simplemente brillantes.',
        image: '/storage/images/peliculas/matrix.webp',
    },
    {
        user: 'Luis Ramírez',
        title: 'Pulp Fiction',
        category: 'película',
        description: 'Quentin Tarantino en su máxima expresión. Es una película que te mantiene pegado a la pantalla con sus diálogos y su narrativa no lineal.',
        image: '/storage/images/peliculas/pulp_fiction.webp',
    },
    {
        user: 'Marta López',
        title: 'El Rey León',
        category: 'película',
        description: 'Una película animada que te hará reír, llorar y cantar. Es un clásico que no envejece. Hakuna Matata, ¡vuelve a verla!',
        image: '/storage/images/peliculas/el_rey_leon.webp',
    },
    {
        user: 'Carlos Muñoz',
        title: 'Gladiador',
        category: 'película',
        description: 'Una de las mejores películas de acción y drama histórico. La actuación de Russell Crowe es épica. Te sentirás como en la arena del Coliseo.',
        image: '/storage/images/peliculas/gladiador.webp',
    },
    {
        user: 'Laura Fernández',
        title: 'Amélie',
        category: 'película',
        description: 'Es una película llena de encanto y magia. Amélie es un personaje adorable y su historia es simplemente encantadora. ¡Te va a hacer sonreír!',
        image: '/storage/images/peliculas/amelie.webp',
    },
    {
        user: 'Jorge Castillo',
        title: 'Star Wars: El Imperio Contraataca',
        category: 'película',
        description: 'La mejor película de la saga Star Wars. Llena de momentos icónicos y giros inesperados. ¡La Fuerza es poderosa en esta!',
        image: '/storage/images/peliculas/el_imperio_contraataca.webp',
    },
    {
        user: 'Elena García',
        title: 'Interstellar',
        category: 'película',
        description: 'Una aventura espacial que explora el amor, el tiempo y la ciencia de una manera fascinante. Christopher Nolan lo hace de nuevo.',
        image: '/storage/images/peliculas/interstellar.webp',
    },
    {
        user: 'Pedro Ortega',
        title: 'La Vida es Bella',
        category: 'película',
        description: 'Una película conmovedora que mezcla humor y tragedia de una manera brillante. Te hará reír y llorar al mismo tiempo.',
        image: '/storage/images/peliculas/la_vida_es_bella.jpeg',
    },
    {
        user: 'Ana Martínez',
        title: 'Friends',
        category: 'serie',
        description: '¡Nunca me canso de ver esta serie! Cada episodio es pura diversión. ¡Si no la has visto, tienes que hacerlo ahora!',
        image: '/storage/images/series/friends.jpg',
    },
    {
        user: 'Luis Fernández',
        title: 'Game of Thrones',
        category: 'serie',
        description: 'Un viaje épico lleno de intriga, poder y dragones. Aunque el final fue divisivo, ¡la serie es absolutamente imprescindible!',
        image: '/storage/images/series/game_of_thrones.jpg',
    },
    {
        user: 'Laura Gómez',
        title: 'The Office',
        category: 'serie',
        description: 'La comedia de oficina por excelencia. Michael Scott y su equipo te harán reír hasta que duela la barriga.',
        image: '/storage/images/series/the_office.jpg',
    },
    {
        user: 'Jorge Rodríguez',
        title: 'Stranger Things',
        category: 'serie',
        description: '¡Es como una carta de amor a los 80s con una buena dosis de misterio y ciencia ficción! ¡Los personajes son geniales!',
        image: 'storage/images/peliculas/strangerthiks.jpg',
    },
    {
        user: 'Elena López',
        title: 'Breaking Bad',
        category: 'serie',
        description: 'Una obra maestra de la televisión. La transformación de Walter White es algo que tienes que ver para creer.',
        image: '/storage/images/peliculas/Breaking_bad_season5.webp',
    },
    {
        user: 'Carlos Sánchez',
        title: 'Sherlock',
        category: 'serie',
        description: 'Benedict Cumberbatch como Sherlock Holmes es simplemente brillante. Cada episodio es como una mini película.',
        image: '/storage/images/series/sherlock.jpg',
    },
    {
        user: 'Sofía Ramírez',
        title: 'La Casa de Papel',
        category: 'serie',
        description: 'Un atraco que te mantendrá al borde de tu asiento. ¡El Profesor es un genio, y la serie te enganchará desde el primer episodio!',
        image: '/storage/images/series/la_casa_de_papel.jpeg',
    },
    {
        user: 'Pablo Ortega',
        title: 'Narcos',
        category: 'serie',
        description: 'La historia de Pablo Escobar es fascinante y aterradora al mismo tiempo. ¡Una serie llena de acción y drama!',
        image: '/storage/images/series/narcos.jpg',
    },
    {
        user: 'Clara Martínez',
        title: 'Black Mirror',
        category: 'serie',
        description: 'Una serie que te hace pensar en la tecnología y su impacto en nuestras vidas. Cada episodio es una historia distinta y te dejará reflexionando.',
        image: '/storage/images/series/black_mirror.jpg',
    },
    {
        user: 'Alberto Delgado',
        title: 'The Crown',
        category: 'serie',
        description: 'Una mirada fascinante a la vida de la Reina Isabel II. La producción es impecable, y cada temporada es mejor que la anterior.',
        image: '/storage/images/series/the_crown.jpg',
    },
    {
        user: 'Manuel Canales',
        title: 'The Legend of Zelda: Breath of the Wild',
        category: 'game',
        description: 'Este juego redefine lo que significa una aventura en mundo abierto. Es pura libertad y descubrimiento. ¡No te lo puedes perder!',
        image: '/storage/images/games/The_Legend_of_Zelda_Breath_of_the_Wild.jpg',
    },
    {
        user: 'Daniel Castro',
        title: 'The Witcher 3: Wild Hunt',
        category: 'game',
        description: 'Un RPG épico con una historia increíble y personajes memorables. El mundo es tan rico y detallado que te perderás en él por horas.',
        image: '/storage/images/games/the_witcher_3.jpeg',
    },
    {
        user: 'Karla Díaz',
        title: 'Red Dead Redemption 2',
        category: 'game',
        description: 'Este juego es como vivir una película del oeste. La atención al detalle es impresionante, y la historia te atrapa desde el primer momento.',
        image: '/storage/images/games/red_dead_redemption_2.jpeg',
    },
    {
        user: 'Luis Méndez',
        title: 'Super Mario Odyssey',
        category: 'game',
        description: 'Es uno de los juegos más divertidos y creativos que he jugado. Cada nivel es una nueva sorpresa. ¡Mario nunca decepciona!',
        image: '/storage/images/games/super_mario_odyssey.jpg',
    },
    {
        user: 'Elena Torres',
        title: 'Hades',
        category: 'game',
        description: 'Un juego de acción rápida con una historia envolvente. Los diálogos y personajes son simplemente geniales. ¡No te lo pierdas!',
        image: '/storage/images/games/hades.webp',
    },
    {
        user: 'Pablo Rodríguez',
        title: 'Minecraft',
        category: 'game',
        description: 'Un juego donde puedes dejar volar tu imaginación. La libertad de crear lo que quieras es adictiva y siempre hay algo nuevo por hacer.',
        image: '/storage/images/games/minecraft.jpeg',
    },
    {
        user: 'Sofía Navarro',
        title: 'God of War',
        category: 'game',
        description: 'Kratos está de vuelta, y esta vez con una historia más profunda y emotiva. La jugabilidad es impresionante, y los gráficos son espectaculares.',
        image: '/storage/images/games/god_of_war.webp',
    },
    {
        user: 'Clara Ortiz',
        title: 'Overwatch',
        category: 'game',
        description: 'Un juego de disparos en equipo que es pura diversión. Cada héroe tiene su propio estilo de juego, ¡y nunca te aburres!',
        image: '/storage/images/games/overwatch.jpeg',
    },
    {
        user: 'José Rojas',
        title: 'The Last of Us Part II',
        category: 'game',
        description: 'Un juego que te rompe el corazón pero te atrapa con su historia. Es emocionalmente intenso y bellamente diseñado.',
        image: '/storage/images/games/the_last_of_us_part_2.jpeg',
    },
    {
        user: 'María Peña',
        title: 'Fortnite',
        category: 'game',
        description: 'Un juego de batalla real que es pura adrenalina. Las actualizaciones constantes y la creatividad de la comunidad lo hacen siempre fresco.',
        image: '/storage/images/games/fortnite.jpeg',
    },
    {
        user: 'Kenia Bell',
        title: 'The Miseducation of Lauryn Hill',
        category: 'música',
        description: 'De los mejores discos de la historia de la música. Cada canción es una joya, y la voz de Lauryn Hill es pura magia.',
        image: '/storage/images/discos/the_miseducationjpeg.jpeg',
    },
    {
        user: 'Mark Times',
        title: 'Abbey Road - The Beatles',
        category: 'música',
        description: '¡Es un clásico atemporal! Las melodías, las letras... simplemente todo. No hay una canción en este álbum que no sea increíble.',
        image: '/storage/images/discos/abbey_road.webp',
    },
    {
        user: 'Ana López',
        title: 'Thriller - Michael Jackson',
        category: 'música',
        description: 'El álbum más vendido de todos los tiempos por una razón. Cada pista es icónica, y Michael Jackson está en su mejor momento.',
        image: '/storage/images/discos/thriller.jpeg',
    },
    {
        user: 'Carlos Muñoz',
        title: 'Back to Black - Amy Winehouse',
        category: 'música',
        description: 'La voz y el estilo de Amy son únicos. Este álbum es una montaña rusa de emociones, y cada canción te llega al corazón.',
        image: '/storage/images/discos/back_to_black.jpeg',
    },
    {
        user: 'Elena Gómez',
        title: 'Dark Side of the Moon - Pink Floyd',
        category: 'música',
        description: 'Un viaje musical que te lleva a otra dimensión. La producción, las letras... todo en este álbum es perfecto.',
        image: '/storage/images/discos/dark_side_of_the_moon.jpg',
    },
    {
        user: 'Luis Ramírez',
        title: 'Rumours - Fleetwood Mac',
        category: 'música',
        description: 'Uno de los álbumes más icónicos de los 70. Las armonías, las letras, todo es simplemente mágico.',
        image: '/storage/images/discos/rumours.jpg',
    },
    {
        user: 'Marta Ortega',
        title: 'A Night at the Opera - Queen',
        category: 'música',
        description: 'Bohemian Rhapsody es solo el comienzo. Este álbum es una obra maestra de principio a fin. ¡Freddie Mercury es un genio!',
        image: '/storage/images/discos/a_night_at_the_opera.jpeg',
    },
    {
        user: 'Pablo Torres',
        title: 'Born to Run - Bruce Springsteen',
        category: 'música',
        description: 'Es un himno de libertad y esperanza. La energía de Bruce Springsteen es contagiosa, y este álbum es un clásico.',
        image: '/storage/images/discos/born_to_run.jpeg',
    },
    {
        user: 'Sofía Martínez',
        title: 'Lemonade - Beyoncé',
        category: 'música',
        description: 'Un álbum que rompe barreras y desafía géneros. Beyoncé es poderosa y vulnerable al mismo tiempo. ¡Es impresionante!',
        image: '/storage/images/discos/lemonade.jpeg',
    },
    {
        user: 'Carlos Fernández',
        title: 'Nevermind - Nirvana',
        category: 'música',
        description: 'El grunge en su máxima expresión. La voz de Kurt Cobain, la energía... es un álbum que define una generación.',
        image: '/storage/images/discos/nevermind.jpeg',
    }
]);


// const recommendations = ref([

// { id: 1, title: 'El nombre del viento', category: 'book', description: 'Una obra maestra que reinventa la fantasía moderna con personajes memorables y una narrativa cautivadora.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 2, title: 'Cien años de soledad', category: 'book', description: 'Una saga épica de la familia Buendía, narrada con una magia y profundidad inigualables.', user: 'The New York Times', image: 'https://via.placeholder.com/150' },
// { id: 3, title: 'La sombra del viento', category: 'book', description: 'Un homenaje al poder de los libros en una historia llena de misterio, amor y tragedia.', user: 'Los Angeles Times', image: 'https://via.placeholder.com/150' },
// { id: 4, title: '1984', category: 'book', description: 'Una crítica feroz al totalitarismo que sigue siendo tan relevante hoy como lo fue cuando se publicó.', user: 'The Times', image: 'https://via.placeholder.com/150' },
// { id: 5, title: 'Crimen y castigo', category: 'book', description: 'Un viaje psicológico a través de la mente de un asesino y su lucha con la culpa y la redención.', user: 'The New Yorker', image: 'https://via.placeholder.com/150' },
// { id: 6, title: 'Matar a un ruiseñor', category: 'book', description: 'Un testimonio poderoso de la injusticia racial en el sur de Estados Unidos.', user: 'The Washington Post', image: 'https://via.placeholder.com/150' },
// { id: 7, title: 'El gran Gatsby', category: 'book', description: 'Una novela lírica sobre la ambición, el amor y el desmoronamiento del sueño americano.', user: 'The Telegraph', image: 'https://via.placeholder.com/150' },
// { id: 8, title: 'Orgullo y prejuicio', category: 'book', description: 'Una historia de amor y sociedad en la Inglaterra del siglo XIX, escrita con ingenio y agudeza.', user: 'The Independent', image: 'https://via.placeholder.com/150' },
// { id: 9, title: 'El retrato de Dorian Gray', category: 'book', description: 'Una exploración oscura del hedonismo y la moralidad que sigue siendo fascinante y perturbadora.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 10, title: 'Los miserables', category: 'book', description: 'Una épica sobre la lucha por la redención en medio de la pobreza y la injusticia.', user: 'The New York Times', image: 'https://via.placeholder.com/150' },
// { id: 11, title: 'El caballero oscuro', category: 'movie', description: 'Una película que redefine el género de superhéroes con una actuación icónica de Heath Ledger.', user: 'Roger Ebert', image: 'https://via.placeholder.com/150' },
// { id: 12, title: 'Pulp Fiction', category: 'movie', description: 'Una obra maestra del cine moderno que mezcla violencia, humor y narrativa no lineal.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 13, title: 'La lista de Schindler', category: 'movie', description: 'Una poderosa representación del Holocausto que destaca la capacidad del cine para conmover y educar.', user: 'The New York Times', image: 'https://via.placeholder.com/150' },
// { id: 14, title: 'El padrino', category: 'movie', description: 'Una obra de arte cinematográfica que explora la familia, el poder y la corrupción.', user: 'Variety', image: 'https://via.placeholder.com/150' },
// { id: 15, title: 'El club de la lucha', category: 'movie', description: 'Un comentario subversivo sobre la masculinidad y la sociedad de consumo.', user: 'Empire', image: 'https://via.placeholder.com/150' },
// { id: 16, title: 'Matrix', category: 'movie', description: 'Una revolución visual y filosófica que cuestiona la realidad y la tecnología.', user: 'IGN', image: 'https://via.placeholder.com/150' },
// { id: 17, title: 'Forrest Gump', category: 'movie', description: 'Una historia emotiva y encantadora que celebra la simplicidad de la vida.', user: 'Rolling Stone', image: 'https://via.placeholder.com/150' },
// { id: 18, title: 'El señor de los anillos: La comunidad del anillo', category: 'movie', description: 'Una épica de fantasía que establece un nuevo estándar en la realización cinematográfica.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 19, title: 'Titanic', category: 'movie', description: 'Una narración monumental de amor y tragedia que capturó la imaginación del mundo.', user: 'The Hollywood Reporter', image: 'https://via.placeholder.com/150' },
// { id: 20, title: 'Gladiator', category: 'movie', description: 'Una epopeya visualmente impactante con una actuación inolvidable de Russell Crowe.', user: 'Empire', image: 'https://via.placeholder.com/150' },
// { id: 21, title: 'Don Quijote de la Mancha', category: 'book', description: 'Un clásico que explora la locura y el idealismo en una de las obras más importantes de la literatura.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 22, title: 'El hombre invisible', category: 'book', description: 'Una inquietante historia de ciencia ficción que cuestiona la moralidad y el poder.', user: 'The New Yorker', image: 'https://via.placeholder.com/150' },
// { id: 23, title: 'Jane Eyre', category: 'book', description: 'Una poderosa novela sobre la independencia y la fuerza del espíritu humano.', user: 'The Telegraph', image: 'https://via.placeholder.com/150' },
// { id: 24, title: 'Fahrenheit 451', category: 'book', description: 'Una advertencia atemporal sobre la censura y la destrucción del conocimiento.', user: 'The Independent', image: 'https://via.placeholder.com/150' },
// { id: 25, title: 'Frankenstein', category: 'book', description: 'Una novela gótica que plantea preguntas fundamentales sobre la ciencia, la creación y la responsabilidad.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 26, title: 'Drácula', category: 'book', description: 'Una historia que definió el género de terror, con un villano que sigue siendo fascinante.', user: 'The New York Times', image: 'https://via.placeholder.com/150' },
// { id: 27, title: 'El extraño caso del Dr. Jekyll y Mr. Hyde', category: 'book', description: 'Un relato sombrío sobre la dualidad de la naturaleza humana.', user: 'The Times', image: 'https://via.placeholder.com/150' },
// { id: 28, title: 'La casa de los espíritus', category: 'book', description: 'Una saga familiar mágica y conmovedora que mezcla lo real con lo sobrenatural.', user: 'The Washington Post', image: 'https://via.placeholder.com/150' },
// { id: 29, title: 'La carretera', category: 'book', description: 'Una devastadora historia de supervivencia en un mundo postapocalíptico.', user: 'Los Angeles Times', image: 'https://via.placeholder.com/150' },
// { id: 30, title: 'El Hobbit', category: 'book', description: 'Una aventura épica que ha inspirado generaciones de lectores y creadores de fantasía.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 31, title: 'Taxi Driver', category: 'movie', description: 'Un estudio de personajes sombrío y perturbador que redefine el cine estadounidense.', user: 'Roger Ebert', image: 'https://via.placeholder.com/150' },
// { id: 32, title: 'El resplandor', category: 'movie', description: 'Una obra maestra del horror psicológico con una atmósfera inquietante y una actuación escalofriante.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 33, title: 'Apocalypse Now', category: 'movie', description: 'Una película de guerra que explora la locura y la desesperación con una intensidad sin igual.', user: 'The New York Times', image: 'https://via.placeholder.com/150' },
// { id: 34, title: 'Reservoir Dogs', category: 'movie', description: 'Un thriller criminal lleno de tensión y estilo, que marcó el debut de Quentin Tarantino.', user: 'Empire', image: 'https://via.placeholder.com/150' },
// { id: 35, title: 'Alien: El octavo pasajero', category: 'movie', description: 'Un clásico del cine de ciencia ficción que combina horror y suspenso con perfección.', user: 'IGN', image: 'https://via.placeholder.com/150' },
// { id: 36, title: 'La naranja mecánica', category: 'movie', description: 'Una exploración perturbadora de la violencia y el control social, dirigida con audacia por Kubrick.', user: 'The Hollywood Reporter', image: 'https://via.placeholder.com/150' },
// { id: 37, title: 'Mad Max: Furia en la carretera', category: 'movie', description: 'Una epopeya postapocalíptica con secuencias de acción inigualables y un enfoque visual innovador.', user: 'Variety', image: 'https://via.placeholder.com/150' },
// { id: 38, title: 'El gran Lebowski', category: 'movie', description: 'Una comedia de culto que ha ganado una legión de fans por su humor absurdo y personajes únicos.', user: 'Rolling Stone', image: 'https://via.placeholder.com/150' },
// { id: 39, title: 'Los infiltrados', category: 'movie', description: 'Un thriller criminal magistralmente dirigido que mantiene la tensión hasta el último minuto.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 40, title: 'La La Land', category: 'movie', description: 'Un homenaje vibrante y emocional al cine y la música, con actuaciones y dirección impecables.', user: 'The New York Times', image: 'https://via.placeholder.com/150' },
// { id: 41, title: 'Breaking Bad', category: 'series', description: 'Una serie revolucionaria que narra la transformación de un profesor en un poderoso narcotraficante.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 42, title: 'Game of Thrones', category: 'series', description: 'Un fenómeno cultural que combina intriga política, fantasía y personajes inolvidables.', user: 'The New York Times', image: 'https://via.placeholder.com/150' },
// { id: 43, title: 'The Wire', category: 'series', description: 'Una exploración profunda y realista de la vida urbana y la corrupción en Baltimore.', user: 'The Washington Post', image: 'https://via.placeholder.com/150' },
// { id: 44, title: 'Stranger Things', category: 'series', description: 'Un éxito nostálgico que mezcla ciencia ficción, horror y aventuras en una historia cautivadora.', user: 'Los Angeles Times', image: 'https://via.placeholder.com/150' },
// { id: 45, title: 'Los Soprano', category: 'series', description: 'Una serie que redefine el género de mafiosos, centrándose en el aspecto humano y psicológico de su protagonista.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 46, title: 'Black Mirror', category: 'series', description: 'Una antología inquietante que explora los peligros de la tecnología moderna.', user: 'The Independent', image: 'https://via.placeholder.com/150' },
// { id: 47, title: 'Chernobyl', category: 'series', description: 'Una reconstrucción aterradora y conmovedora de uno de los peores desastres nucleares de la historia.', user: 'The New Yorker', image: 'https://via.placeholder.com/150' },
// { id: 48, title: 'The Crown', category: 'series', description: 'Una mirada fascinante y detallada a la vida de la reina Isabel II y la monarquía británica.', user: 'The Times', image: 'https://via.placeholder.com/150' },
// { id: 49, title: 'Better Call Saul', category: 'series', description: 'Una precuela brillante y compleja que expande el universo de Breaking Bad.', user: 'The Hollywood Reporter', image: 'https://via.placeholder.com/150' },
// { id: 50, title: 'Fargo', category: 'series', description: 'Una serie antológica que mezcla humor negro y violencia en una narrativa única.', user: 'Variety', image: 'https://via.placeholder.com/150' },
// { id: 51, title: 'The Dark Side of the Moon', category: 'music', description: 'Un álbum revolucionario que redefinió el rock progresivo con sus innovadoras técnicas de grabación.', user: 'Rolling Stone', image: 'https://via.placeholder.com/150' },
// { id: 52, title: 'Abbey Road', category: 'music', description: 'El último álbum grabado por The Beatles, una obra maestra que combina innovación y melodías atemporales.', user: 'NME', image: 'https://via.placeholder.com/150' },
// { id: 53, title: 'Thriller', category: 'music', description: 'El álbum más vendido de todos los tiempos, que consolidó a Michael Jackson como el Rey del Pop.', user: 'Billboard', image: 'https://via.placeholder.com/150' },
// { id: 54, title: 'Back in Black', category: 'music', description: 'Un álbum icónico de AC/DC, que se convirtió en un símbolo del rock y la resistencia.', user: 'Classic Rock', image: 'https://via.placeholder.com/150' },
// { id: 55, title: 'Nevermind', category: 'music', description: 'El álbum que definió el grunge y catapultó a Nirvana al estrellato mundial.', user: 'Pitchfork', image: 'https://via.placeholder.com/150' },
// { id: 56, title: 'Rumours', category: 'music', description: 'Una obra maestra del rock suave, que capturó las turbulencias emocionales de Fleetwood Mac.', user: 'Rolling Stone', image: 'https://via.placeholder.com/150' },
// { id: 57, title: 'The Wall', category: 'music', description: 'Un álbum conceptual ambicioso y profundamente personal de Pink Floyd.', user: 'NME', image: 'https://via.placeholder.com/150' },
// { id: 58, title: 'Sgt. Pepper\'s Lonely Hearts Club Band', category: 'music', description: 'Un hito en la música pop que expandió los límites de lo que un álbum podía ser.', user: 'Mojo', image: 'https://via.placeholder.com/150' },
// { id: 59, title: 'Born to Run', category: 'music', description: 'El álbum que consolidó a Bruce Springsteen como el "Jefe", lleno de pasión y energía juvenil.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 60, title: 'Hotel California', category: 'music', description: 'Un álbum icónico de The Eagles, que mezcla rock y country con letras evocadoras.', user: 'Rolling Stone', image: 'https://via.placeholder.com/150' },
// { id: 61, title: 'The Legend of Zelda: Breath of the Wild', category: 'game', description: 'Una obra maestra que redefinió los juegos de mundo abierto con su exploración y libertad sin precedentes.', user: 'IGN', image: 'https://via.placeholder.com/150' },
// { id: 62, title: 'Red Dead Redemption 2', category: 'game', description: 'Un western épico que combina una narrativa profunda con un mundo abierto vivo y detallado.', user: 'GameSpot', image: 'https://via.placeholder.com/150' },
// { id: 63, title: 'The Witcher 3: Wild Hunt', category: 'game', description: 'Un juego de rol que ofrece una experiencia rica y expansiva, con personajes complejos y un mundo fascinante.', user: 'PC Gamer', image: 'https://via.placeholder.com/150' },
// { id: 64, title: 'God of War', category: 'game', description: 'Una reinvención poderosa de la serie, que mezcla acción intensa con una narrativa emocional.', user: 'Game Informer', image: 'https://via.placeholder.com/150' },
// { id: 65, title: 'Minecraft', category: 'game', description: 'Un fenómeno cultural que ha permitido a millones de jugadores crear, explorar y sobrevivir en un mundo de bloques.', user: 'Polygon', image: 'https://via.placeholder.com/150' },
// { id: 66, title: 'Grand Theft Auto V', category: 'game', description: 'Un juego de mundo abierto que sigue siendo un estándar en la industria por su detalle y su narrativa multifacética.', user: 'GameSpot', image: 'https://via.placeholder.com/150' },
// { id: 67, title: 'Dark Souls', category: 'game', description: 'Un juego que desafía a los jugadores con su dificultad brutal, pero justo, y su mundo oscuro y misterioso.', user: 'Eurogamer', image: 'https://via.placeholder.com/150' },
// { id: 68, title: 'Super Mario Odyssey', category: 'game', description: 'Una aventura colorida y creativa que reinventa lo que un juego de plataformas puede ser.', user: 'IGN', image: 'https://via.placeholder.com/150' },
// { id: 69, title: 'The Last of Us Part II', category: 'game', description: 'Una narrativa valiente y desgarradora que empuja los límites de lo que un videojuego puede lograr emocionalmente.', user: 'The Verge', image: 'https://via.placeholder.com/150' },
// { id: 70, title: 'Bloodborne', category: 'game', description: 'Un juego de acción y terror gótico que combina un combate rápido y preciso con una atmósfera opresiva.', user: 'Game Informer', image: 'https://via.placeholder.com/150' },
// { id: 71, title: 'Machu Picchu', category: 'tourist destination', description: 'Una de las maravillas del mundo moderno, una ciudadela inca rodeada de montañas impresionantes.', user: 'National Geographic', image: 'https://via.placeholder.com/150' },
// { id: 72, title: 'Gran Cañón', category: 'tourist destination', description: 'Una asombrosa formación natural que ofrece vistas espectaculares y caminatas desafiantes.', user: 'Travel + Leisure', image: 'https://via.placeholder.com/150' },
// { id: 73, title: 'Taj Mahal', category: 'tourist destination', description: 'Un monumento al amor construido en mármol blanco, una de las estructuras más bellas del mundo.', user: 'Lonely Planet', image: 'https://via.placeholder.com/150' },
// { id: 74, title: 'Santorini', category: 'tourist destination', description: 'Una isla griega famosa por sus casas blancas, cúpulas azules y puestas de sol impresionantes.', user: 'Condé Nast Traveler', image: 'https://via.placeholder.com/150' },
// { id: 75, title: 'La Gran Muralla China', category: 'tourist destination', description: 'Una de las construcciones más impresionantes de la historia, que serpentea a través de montañas y valles.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 76, title: 'Petra', category: 'tourist destination', description: 'Una ciudad tallada en la roca, que ofrece una visión fascinante de la antigua civilización nabatea.', user: 'National Geographic', image: 'https://via.placeholder.com/150' },
// { id: 77, title: 'Parque Nacional de Yellowstone', category: 'tourist destination', description: 'Un paraíso natural lleno de géiseres, fauna salvaje y paisajes impresionantes.', user: 'Travel + Leisure', image: 'https://via.placeholder.com/150' },
// { id: 78, title: 'La Torre Eiffel', category: 'tourist destination', description: 'El símbolo icónico de París y uno de los monumentos más reconocidos en todo el mundo.', user: 'Condé Nast Traveler', image: 'https://via.placeholder.com/150' },
// { id: 79, title: 'Islas Galápagos', category: 'tourist destination', description: 'Un archipiélago volcánico famoso por su biodiversidad única y su papel en la teoría de la evolución de Darwin.', user: 'Lonely Planet', image: 'https://via.placeholder.com/150' },
// { id: 80, title: 'Auroras Boreales en Noruega', category: 'tourist destination', description: 'Un espectáculo natural impresionante donde el cielo se ilumina con luces danzantes en el Ártico.', user: 'National Geographic', image: 'https://via.placeholder.com/150' },
// { id: 81, title: 'El amor en los tiempos del cólera', category: 'book', description: 'Una historia de amor eterno y de la lucha contra el tiempo, contada con la belleza lírica de García Márquez.', user: 'The New York Times', image: 'https://via.placeholder.com/150' },
// { id: 82, title: 'El señor de las moscas', category: 'book', description: 'Una novela que explora la oscuridad inherente en la naturaleza humana a través de un grupo de niños varados en una isla.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 83, title: 'Moby Dick', category: 'book', description: 'Una epopeya sobre la obsesión y la venganza, ambientada en los vastos océanos.', user: 'The New Yorker', image: 'https://via.placeholder.com/150' },
// { id: 84, title: 'Ulises', category: 'book', description: 'Una obra maestra de la literatura modernista, conocida por su complejidad y profundidad.', user: 'The Times', image: 'https://via.placeholder.com/150' },
// { id: 85, title: 'El guardián entre el centeno', category: 'book', description: 'Una novela que captura la angustia y la alienación de la juventud, narrada por el icónico Holden Caulfield.', user: 'The Washington Post', image: 'https://via.placeholder.com/150' },
// { id: 86, title: 'El conde de Montecristo', category: 'book', description: 'Una historia épica de venganza y justicia que ha cautivado a los lectores durante generaciones.', user: 'The Telegraph', image: 'https://via.placeholder.com/150' },
// { id: 87, title: 'Anna Karenina', category: 'book', description: 'Una tragedia romántica que explora el amor, la infidelidad y las diferencias sociales en la Rusia imperial.', user: 'The Independent', image: 'https://via.placeholder.com/150' },
// { id: 88, title: 'Las uvas de la ira', category: 'book', description: 'Una narración poderosa sobre la lucha de una familia durante la Gran Depresión en Estados Unidos.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 89, title: 'Cumbres Borrascosas', category: 'book', description: 'Una historia de amor apasionada y destructiva que ha perdurado a lo largo de los siglos.', user: 'The New York Times', image: 'https://via.placeholder.com/150' },
// { id: 90, title: 'Las aventuras de Huckleberry Finn', category: 'book', description: 'Una novela que cuestiona las normas sociales y raciales de la época a través de las aventuras de un joven en el Mississippi.', user: 'Los Angeles Times', image: 'https://via.placeholder.com/150' },
// { id: 91, title: 'El bueno, el malo y el feo', category: 'movie', description: 'Un western épico que ha definido el género con sus personajes icónicos y su tensión implacable.', user: 'Empire', image: 'https://via.placeholder.com/150' },
// { id: 92, title: 'E.T. El extraterrestre', category: 'movie', description: 'Una historia conmovedora sobre la amistad y la pérdida que ha tocado el corazón de millones.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 93, title: 'Rocky', category: 'movie', description: 'Un drama inspirador sobre un boxeador que lucha por su oportunidad de gloria, encarnado por Sylvester Stallone.', user: 'Rolling Stone', image: 'https://via.placeholder.com/150' },
// { id: 94, title: 'El exorcista', category: 'movie', description: 'Una de las películas de terror más aterradoras jamás realizadas, que sigue siendo perturbadora décadas después.', user: 'The New York Times', image: 'https://via.placeholder.com/150' },
// { id: 95, title: 'Indiana Jones y los cazadores del arca perdida', category: 'movie', description: 'Una aventura de ritmo trepidante que estableció a Indiana Jones como un ícono cinematográfico.', user: 'Variety', image: 'https://via.placeholder.com/150' },
// { id: 96, title: 'El silencio de los inocentes', category: 'movie', description: 'Un thriller psicológico que presentó al mundo a Hannibal Lecter, uno de los villanos más memorables del cine.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 97, title: 'Toy Story', category: 'movie', description: 'La película que inició una revolución en la animación por computadora y se convirtió en un clásico instantáneo.', user: 'IGN', image: 'https://via.placeholder.com/150' },
// { id: 98, title: 'Jurassic Park', category: 'movie', description: 'Una mezcla perfecta de efectos especiales innovadores y una narrativa emocionante que cautivó al público.', user: 'The Hollywood Reporter', image: 'https://via.placeholder.com/150' },
// { id: 99, title: 'El gran hotel Budapest', category: 'movie', description: 'Una comedia encantadora y visualmente deslumbrante que mezcla la fantasía con la melancolía.', user: 'The New Yorker', image: 'https://via.placeholder.com/150' },
// { id: 100, title: 'Blade Runner 2049', category: 'movie', description: 'Una secuela visualmente impresionante que expande el universo original con temas profundos y filosóficos.', user: 'Empire', image: 'https://via.placeholder.com/150' },
// { id: 101, title: 'Friends', category: 'series', description: 'Una comedia icónica que ha definido una era, con personajes que se han convertido en parte de la cultura popular.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 102, title: 'The Office (US)', category: 'series', description: 'Una sátira del lugar de trabajo que combina humor incómodo con momentos de auténtica calidez.', user: 'The New York Times', image: 'https://via.placeholder.com/150' },
// { id: 103, title: 'Twin Peaks', category: 'series', description: 'Una serie surrealista que ha mantenido a los espectadores intrigados con su mezcla de misterio, terror y surrealismo.', user: 'Variety', image: 'https://via.placeholder.com/150' },
// { id: 104, title: 'Seinfeld', category: 'series', description: 'Una comedia sobre "nada" que redefinió lo que la televisión podía ser, con un humor que sigue resonando.', user: 'Rolling Stone', image: 'https://via.placeholder.com/150' },
// { id: 105, title: 'The Simpsons', category: 'series', description: 'Una serie animada que ha capturado y satirizado la cultura estadounidense durante más de tres décadas.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 106, title: 'Doctor Who', category: 'series', description: 'Una serie de ciencia ficción que ha pasado a ser un pilar de la cultura británica con su mezcla de aventura y reflexión.', user: 'The Independent', image: 'https://via.placeholder.com/150' },
// { id: 107, title: 'The Mandalorian', category: 'series', description: 'Una serie que ha revivido la saga de Star Wars, con una mezcla perfecta de acción, emoción y nostalgia.', user: 'IGN', image: 'https://via.placeholder.com/150' },
// { id: 108, title: 'True Detective', category: 'series', description: 'Una antología que mezcla el noir con el drama psicológico en historias llenas de misterio y oscuridad.', user: 'The Hollywood Reporter', image: 'https://via.placeholder.com/150' },
// { id: 109, title: 'Peaky Blinders', category: 'series', description: 'Un drama de época que sigue a una familia de gánsteres en la Inglaterra post-Primera Guerra Mundial.', user: 'Empire', image: 'https://via.placeholder.com/150' },
// { id: 110, title: 'Westworld', category: 'series', description: 'Una serie que explora la inteligencia artificial y la moralidad en un parque temático futurista.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 111, title: 'Led Zeppelin IV', category: 'music', description: 'Un álbum que cementó a Led Zeppelin como uno de los mejores grupos de rock de todos los tiempos.', user: 'Rolling Stone', image: 'https://via.placeholder.com/150' },
// { id: 112, title: 'A Night at the Opera', category: 'music', description: 'Un álbum operático y ambicioso que destaca la versatilidad y el talento de Queen.', user: 'NME', image: 'https://via.placeholder.com/150' },
// { id: 113, title: 'Purple Rain', category: 'music', description: 'Una obra maestra que mezcla rock, R&B y pop, consolidando a Prince como un genio musical.', user: 'Billboard', image: 'https://via.placeholder.com/150' },
// { id: 114, title: 'The Joshua Tree', category: 'music', description: 'Un álbum que definió a U2 como una de las bandas más importantes del mundo, con su mezcla de rock y espiritualidad.', user: 'Classic Rock', image: 'https://via.placeholder.com/150' },
// { id: 115, title: 'OK Computer', category: 'music', description: 'Un álbum que capturó la alienación y la ansiedad de la era moderna con su innovadora producción y letras.', user: 'Pitchfork', image: 'https://via.placeholder.com/150' },
// { id: 116, title: 'What\'s Going On', category: 'music', description: 'Un álbum que reflejó y resonó con los tiempos turbulentos, convirtiéndose en un clásico del soul.', user: 'Rolling Stone', image: 'https://via.placeholder.com/150' },
// { id: 117, title: 'Exile on Main St.', category: 'music', description: 'Un álbum crudo y ecléctico que representa la esencia de The Rolling Stones.', user: 'NME', image: 'https://via.placeholder.com/150' },
// { id: 118, title: 'London Calling', category: 'music', description: 'Un álbum que mezcló punk, reggae y rockabilly, mostrando la versatilidad y la ambición de The Clash.', user: 'Mojo', image: 'https://via.placeholder.com/150' },
// { id: 119, title: 'Blonde on Blonde', category: 'music', description: 'Un álbum doble que muestra la habilidad de Bob Dylan para mezclar poesía y rock de manera innovadora.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 120, title: 'The Velvet Underground & Nico', category: 'music', description: 'Un álbum que fue ignorado en su tiempo pero que se ha convertido en un referente para la música alternativa.', user: 'Rolling Stone', image: 'https://via.placeholder.com/150' },
// { id: 121, title: 'Horizon Zero Dawn', category: 'game', description: 'Un juego de acción y aventura que combina una historia profunda con un mundo abierto impresionante.', user: 'IGN', image: 'https://via.placeholder.com/150' },
// { id: 122, title: 'Persona 5', category: 'game', description: 'Un juego de rol japonés que mezcla la vida escolar con combates estratégicos y un estilo artístico único.', user: 'GameSpot', image: 'https://via.placeholder.com/150' },
// { id: 123, title: 'Mass Effect 2', category: 'game', description: 'Una ópera espacial que combina una narrativa épica con decisiones que realmente importan.', user: 'PC Gamer', image: 'https://via.placeholder.com/150' },
// { id: 124, title: 'Metal Gear Solid V: The Phantom Pain', category: 'game', description: 'Un juego que ofrece libertad táctica en un vasto mundo abierto, junto con una historia compleja.', user: 'Game Informer', image: 'https://via.placeholder.com/150' },
// { id: 125, title: 'Uncharted 4: A Thief\'s End', category: 'game', description: 'Una aventura cinematográfica que combina acción, exploración y una narrativa emocionante.', user: 'Polygon', image: 'https://via.placeholder.com/150' },
// { id: 126, title: 'The Elder Scrolls V: Skyrim', category: 'game', description: 'Un RPG que ha definido el género de mundo abierto con su inmersión y vastedad.', user: 'GameSpot', image: 'https://via.placeholder.com/150' },
// { id: 127, title: 'BioShock', category: 'game', description: 'Un shooter en primera persona que combina una historia filosófica con un entorno increíblemente atmosférico.', user: 'Eurogamer', image: 'https://via.placeholder.com/150' },
// { id: 128, title: 'Super Smash Bros. Ultimate', category: 'game', description: 'Un juego de lucha que reúne a personajes icónicos en combates frenéticos y divertidos.', user: 'IGN', image: 'https://via.placeholder.com/150' },
// { id: 129, title: 'Final Fantasy VII', category: 'game', description: 'Un clásico del RPG que ha influenciado a generaciones de juegos con su historia y personajes memorables.', user: 'The Verge', image: 'https://via.placeholder.com/150' },
// { id: 130, title: 'Red Dead Redemption', category: 'game', description: 'Un juego de mundo abierto ambientado en el salvaje oeste que combina una narrativa profunda con una jugabilidad increíble.', user: 'Game Informer', image: 'https://via.placeholder.com/150' },
// { id: 131, title: 'París, Francia', category: 'tourist destination', description: 'La ciudad del amor, famosa por su arquitectura, su cultura y su exquisita gastronomía.', user: 'Condé Nast Traveler', image: 'https://via.placeholder.com/150' },
// { id: 132, title: 'Nueva York, Estados Unidos', category: 'tourist destination', description: 'Una metrópolis vibrante conocida como la ciudad que nunca duerme, llena de atracciones icónicas.', user: 'Lonely Planet', image: 'https://via.placeholder.com/150' },
// { id: 133, title: 'Kioto, Japón', category: 'tourist destination', description: 'Una ciudad que combina la serenidad de los templos antiguos con la modernidad vibrante de Japón.', user: 'National Geographic', image: 'https://via.placeholder.com/150' },
// { id: 134, title: 'Venecia, Italia', category: 'tourist destination', description: 'Una ciudad única construida sobre canales, famosa por su romanticismo y su historia.', user: 'Travel + Leisure', image: 'https://via.placeholder.com/150' },
// { id: 135, title: 'Ciudad del Cabo, Sudáfrica', category: 'tourist destination', description: 'Una ciudad con paisajes naturales impresionantes, desde montañas hasta playas.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 136, title: 'Reykjavík, Islandia', category: 'tourist destination', description: 'La capital más septentrional del mundo, famosa por sus paisajes volcánicos y su cultura vikinga.', user: 'Condé Nast Traveler', image: 'https://via.placeholder.com/150' },
// { id: 137, title: 'Sídney, Australia', category: 'tourist destination', description: 'Una ciudad conocida por su icónica Ópera, sus playas y su estilo de vida relajado.', user: 'Lonely Planet', image: 'https://via.placeholder.com/150' },
// { id: 138, title: 'Roma, Italia', category: 'tourist destination', description: 'Una ciudad donde la historia se encuentra en cada esquina, desde el Coliseo hasta el Vaticano.', user: 'National Geographic', image: 'https://via.placeholder.com/150' },
// { id: 139, title: 'Río de Janeiro, Brasil', category: 'tourist destination', description: 'Una ciudad vibrante famosa por su Carnaval, sus playas y su estatua del Cristo Redentor.', user: 'Travel + Leisure', image: 'https://via.placeholder.com/150' },
// { id: 140, title: 'El Cairo, Egipto', category: 'tourist destination', description: 'Una ciudad que combina la modernidad con la historia antigua, famosa por sus pirámides y su museo.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 141, title: 'La divina comedia', category: 'book', description: 'Una obra épica que explora el viaje del alma a través del infierno, el purgatorio y el paraíso.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 142, title: 'El principito', category: 'book', description: 'Un cuento filosófico y poético sobre la inocencia, la soledad y el amor.', user: 'The New York Times', image: 'https://via.placeholder.com/150' },
// { id: 143, title: 'Cien años de soledad', category: 'book', description: 'Una saga familiar que mezcla la realidad con lo mágico en un pueblo mítico de Colombia.', user: 'Los Angeles Times', image: 'https://via.placeholder.com/150' },
// { id: 144, title: 'Lolita', category: 'book', description: 'Una controvertida pero aclamada novela que explora el amor obsesivo y la perversidad.', user: 'The New Yorker', image: 'https://via.placeholder.com/150' },
// { id: 145, title: 'El Perfume', category: 'book', description: 'Una novela inquietante sobre un asesino con un sentido del olfato excepcional.', user: 'The Times', image: 'https://via.placeholder.com/150' },
// { id: 146, title: 'En busca del tiempo perdido', category: 'book', description: 'Una obra monumental que explora la memoria y el tiempo con una prosa exquisita.', user: 'The Washington Post', image: 'https://via.placeholder.com/150' },
// { id: 147, title: 'Los hermanos Karamazov', category: 'book', description: 'Una novela filosófica que explora la moralidad, la fe y el conflicto familiar.', user: 'The Telegraph', image: 'https://via.placeholder.com/150' },
// { id: 148, title: 'El ruido y la furia', category: 'book', description: 'Una narración compleja y experimental que captura la decadencia de una familia sureña.', user: 'The Independent', image: 'https://via.placeholder.com/150' },
// { id: 149, title: 'La metamorfosis', category: 'book', description: 'Un relato alegórico que explora la alienación y la transformación a través de una historia surrealista.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 150, title: '1984', category: 'book', description: 'Una advertencia distópica sobre el totalitarismo y la manipulación, que sigue siendo relevante hoy.', user: 'The New York Times', image: 'https://via.placeholder.com/150' },
// { id: 151, title: 'El padrino II', category: 'movie', description: 'Una secuela que iguala o supera a la original, con una narrativa épica sobre la familia y el poder.', user: 'Empire', image: 'https://via.placeholder.com/150' },
// { id: 152, title: 'Metrópolis', category: 'movie', description: 'Una película pionera de ciencia ficción que presenta una visión distópica de una sociedad futura.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 153, title: 'Psicosis', category: 'movie', description: 'Un thriller psicológico que cambió el cine con su narrativa y su icónica escena en la ducha.', user: 'Rolling Stone', image: 'https://via.placeholder.com/150' },
// { id: 154, title: 'El sexto sentido', category: 'movie', description: 'Un thriller sobrenatural que sorprendió al público con su giro final y una atmósfera inquietante.', user: 'The New York Times', image: 'https://via.placeholder.com/150' },
// { id: 155, title: 'Goodfellas', category: 'movie', description: 'Una de las mejores películas de gánsteres, que ofrece una visión realista y cruda del crimen organizado.', user: 'Variety', image: 'https://via.placeholder.com/150' },
// { id: 156, title: '2001: Una odisea del espacio', category: 'movie', description: 'Una épica de ciencia ficción que explora la evolución humana, el espacio y la inteligencia artificial.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 157, title: 'Casablanca', category: 'movie', description: 'Una historia de amor y sacrificio en tiempos de guerra, que sigue siendo una de las mejores películas jamás hechas.', user: 'IGN', image: 'https://via.placeholder.com/150' },
// { id: 158, title: 'Forrest Gump', category: 'movie', description: 'Una historia inspiradora sobre la simplicidad y la complejidad de la vida, contada a través de los ojos de un hombre extraordinario.', user: 'The Hollywood Reporter', image: 'https://via.placeholder.com/150' },
// { id: 159, title: 'El gran dictador', category: 'movie', description: 'Una sátira mordaz y valiente de Chaplin que ridiculiza a los dictadores y al fascismo.', user: 'The New Yorker', image: 'https://via.placeholder.com/150' },
// { id: 160, title: 'El señor de los anillos: El retorno del rey', category: 'movie', description: 'Una conclusión épica a la trilogía, con batallas espectaculares y un cierre emocional.', user: 'Empire', image: 'https://via.placeholder.com/150' },
// { id: 161, title: 'Sherlock', category: 'series', description: 'Una reinvención moderna del famoso detective, con intrincados casos y un carismático Benedict Cumberbatch.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 162, title: 'Dexter', category: 'series', description: 'Un drama oscuro que sigue a un forense forense que esconde un oscuro secreto como asesino en serie.', user: 'The New York Times', image: 'https://via.placeholder.com/150' },
// { id: 163, title: 'Lost', category: 'series', description: 'Una serie de culto que mezcla misterio, ciencia ficción y drama en una isla llena de secretos.', user: 'Variety', image: 'https://via.placeholder.com/150' },
// { id: 164, title: 'Breaking Bad', category: 'series', description: 'La transformación de un profesor de química en un despiadado narcotraficante, contada con maestría.', user: 'Rolling Stone', image: 'https://via.placeholder.com/150' },
// { id: 165, title: 'Mad Men', category: 'series', description: 'Un drama que captura la esencia de la publicidad en la década de 1960, con personajes complejos y un estilo visual impecable.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 166, title: 'Better Call Saul', category: 'series', description: 'La precuela de Breaking Bad que explora la vida de un abogado de dudosa moralidad.', user: 'The Independent', image: 'https://via.placeholder.com/150' },
// { id: 167, title: 'Westworld', category: 'series', description: 'Una exploración filosófica y visualmente impresionante de la inteligencia artificial y la conciencia.', user: 'IGN', image: 'https://via.placeholder.com/150' },
// { id: 168, title: 'The Crown', category: 'series', description: 'Una mirada detrás de las puertas cerradas del Palacio de Buckingham, explorando la vida de la Reina Isabel II.', user: 'The Hollywood Reporter', image: 'https://via.placeholder.com/150' },
// { id: 169, title: 'Stranger Things', category: 'series', description: 'Un éxito de Netflix que mezcla la nostalgia de los 80 con la ciencia ficción y el terror.', user: 'Empire', image: 'https://via.placeholder.com/150' },
// { id: 170, title: 'The Handmaid\'s Tale', category: 'series', description: 'Una distopía escalofriante que explora temas de opresión, feminismo y resistencia.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 171, title: 'Achtung Baby', category: 'music', description: 'Un álbum que marcó un cambio radical para U2, mezclando rock con electrónica y temas oscuros.', user: 'Rolling Stone', image: 'https://via.placeholder.com/150' },
// { id: 172, title: 'Sticky Fingers', category: 'music', description: 'Un álbum icónico de The Rolling Stones, conocido por su mezcla de blues, rock y sus letras provocadoras.', user: 'NME', image: 'https://via.placeholder.com/150' },
// { id: 173, title: 'Appetite for Destruction', category: 'music', description: 'El debut de Guns N\' Roses que se convirtió en un clásico del hard rock, lleno de energía cruda y actitud.', user: 'Billboard', image: 'https://via.placeholder.com/150' },
// { id: 174, title: 'American Idiot', category: 'music', description: 'Un álbum conceptual de Green Day que criticó la política estadounidense y revitalizó el punk rock.', user: 'Classic Rock', image: 'https://via.placeholder.com/150' },
// { id: 175, title: 'Pet Sounds', category: 'music', description: 'Una obra maestra de The Beach Boys que influenció a innumerables músicos con su complejidad y belleza.', user: 'Pitchfork', image: 'https://via.placeholder.com/150' },
// { id: 176, title: 'Dark Side of the Moon', category: 'music', description: 'Un álbum conceptual de Pink Floyd que explora la locura y la avaricia, con una producción innovadora.', user: 'Rolling Stone', image: 'https://via.placeholder.com/150' },
// { id: 177, title: 'Rumours', category: 'music', description: 'Un álbum clásico de Fleetwood Mac, lleno de confesiones emocionales y armonías perfectas.', user: 'NME', image: 'https://via.placeholder.com/150' },
// { id: 178, title: 'In the Court of the Crimson King', category: 'music', description: 'El álbum debut de King Crimson que definió el rock progresivo con su sonido innovador.', user: 'Mojo', image: 'https://via.placeholder.com/150' },
// { id: 179, title: 'The Rise and Fall of Ziggy Stardust and the Spiders from Mars', category: 'music', description: 'Un álbum conceptual de David Bowie que presentó al mundo a su icónico alter ego, Ziggy Stardust.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 180, title: 'Born to Run', category: 'music', description: 'Un álbum que consolidó a Bruce Springsteen como una de las figuras más importantes del rock.', user: 'Rolling Stone', image: 'https://via.placeholder.com/150' },
// { id: 181, title: 'The Legend of Zelda: Ocarina of Time', category: 'game', description: 'Considerado uno de los mejores videojuegos de todos los tiempos, combinando aventura, rompecabezas y una historia épica.', user: 'IGN', image: 'https://via.placeholder.com/150' },
// { id: 182, title: 'The Last of Us', category: 'game', description: 'Un juego que redefine la narrativa en los videojuegos con una historia profundamente emocional y personajes memorables.', user: 'GameSpot', image: 'https://via.placeholder.com/150' },
// { id: 183, title: 'Super Mario 64', category: 'game', description: 'Un clásico que revolucionó los juegos de plataformas en 3D, estableciendo un nuevo estándar en el diseño de niveles.', user: 'PC Gamer', image: 'https://via.placeholder.com/150' },
// { id: 184, title: 'Half-Life 2', category: 'game', description: 'Un shooter en primera persona que combina una narrativa inmersiva con una jugabilidad innovadora.', user: 'Game Informer', image: 'https://via.placeholder.com/150' },
// { id: 185, title: 'Shadow of the Colossus', category: 'game', description: 'Un juego que mezcla acción y arte, con una historia trágica y una jugabilidad basada en la exploración y la batalla contra colosos.', user: 'Polygon', image: 'https://via.placeholder.com/150' },
// { id: 186, title: 'Portal', category: 'game', description: 'Un innovador juego de rompecabezas en primera persona que desafía la física y la lógica, todo acompañado de un humor oscuro.', user: 'GameSpot', image: 'https://via.placeholder.com/150' },
// { id: 187, title: 'Dark Souls III', category: 'game', description: 'Un juego desafiante conocido por su dificultad brutal, pero justa, y su atmósfera oscura y opresiva.', user: 'Eurogamer', image: 'https://via.placeholder.com/150' },
// { id: 188, title: 'Final Fantasy X', category: 'game', description: 'Un RPG clásico que ofrece una historia emocional, un sistema de combate por turnos y un mundo increíblemente detallado.', user: 'IGN', image: 'https://via.placeholder.com/150' },
// { id: 189, title: 'Resident Evil 4', category: 'game', description: 'Un juego que reinventó la serie Resident Evil, mezclando horror y acción en un formato más dinámico.', user: 'The Verge', image: 'https://via.placeholder.com/150' },
// { id: 190, title: 'Street Fighter II', category: 'game', description: 'Un juego de lucha icónico que estableció muchos de los estándares del género y sigue siendo un favorito en los torneos.', user: 'Game Informer', image: 'https://via.placeholder.com/150' },
// { id: 191, title: 'Barcelona, España', category: 'tourist destination', description: 'Una ciudad vibrante conocida por la arquitectura de Gaudí, su historia y su cultura.', user: 'Condé Nast Traveler', image: 'https://via.placeholder.com/150' },
// { id: 192, title: 'Florencia, Italia', category: 'tourist destination', description: 'La cuna del Renacimiento, llena de arte, historia y una belleza incomparable.', user: 'Lonely Planet', image: 'https://via.placeholder.com/150' },
// { id: 193, title: 'Bali, Indonesia', category: 'tourist destination', description: 'Un paraíso tropical famoso por sus playas, su cultura y su espiritualidad.', user: 'National Geographic', image: 'https://via.placeholder.com/150' },
// { id: 194, title: 'San Francisco, Estados Unidos', category: 'tourist destination', description: 'Una ciudad famosa por su Golden Gate Bridge, sus empinadas calles y su vibrante escena cultural.', user: 'Travel + Leisure', image: 'https://via.placeholder.com/150' },
// { id: 195, title: 'Viena, Austria', category: 'tourist destination', description: 'Una ciudad rica en historia, famosa por su música clásica, sus palacios y su arquitectura imperial.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },
// { id: 196, title: 'Bangkok, Tailandia', category: 'tourist destination', description: 'Una metrópolis bulliciosa conocida por sus templos dorados, su vibrante vida nocturna y su deliciosa comida callejera.', user: 'Condé Nast Traveler', image: 'https://via.placeholder.com/150' },
// { id: 197, title: 'Ámsterdam, Países Bajos', category: 'tourist destination', description: 'Una ciudad famosa por sus canales, su cultura ciclista y sus museos de clase mundial.', user: 'Lonely Planet', image: 'https://via.placeholder.com/150' },
// { id: 198, title: 'Edimburgo, Escocia', category: 'tourist destination', description: 'Una ciudad histórica conocida por su castillo, su festival de arte y su paisaje montañoso.', user: 'National Geographic', image: 'https://via.placeholder.com/150' },
// { id: 199, title: 'Hong Kong, China', category: 'tourist destination', description: 'Una ciudad que combina la modernidad con la tradición, famosa por su impresionante skyline y su comida.', user: 'Travel + Leisure', image: 'https://via.placeholder.com/150' },
// { id: 200, title: 'Kioto, Japón', category: 'tourist destination', description: 'Una ciudad que combina la serenidad de los templos antiguos con la modernidad vibrante de Japón.', user: 'The Guardian', image: 'https://via.placeholder.com/150' },



// ]);


// Función para mezclar recomendaciones de forma reactiva
const shuffleRecommendations = () => {
    recommendations.value = recommendations.value.sort(() => Math.random() - 0.5);
}

// Mezclamos las recomendaciones al cargar la página
shuffleRecommendations();
</script>

<template>

    <Head title="Bienvenido a Clasicón" />

    <div class="relative flex items-center justify-center min-h-screen bg-cover bg-center text-white"
        :style="{ backgroundImage: `url(${backgroundImage})` }">
        <!-- Fondo oscuro transparente -->
        <div class="absolute inset-0 bg-black opacity-50"></div>

        <div class="relative z-10 flex flex-col md:flex-row w-full max-w-screen-xl mx-auto">
            <!-- Sección principal -->
            <div class="flex-1 text-center md:text-left p-6">
                <h1 class="text-4xl md:text-6xl font-bold mb-4">Clasicón.com</h1>
                <p class="text-lg md:text-xl mb-8">Tu espacio para descubrir, compartir y recomendar lo mejor en libros,
                    películas, series, y más.</p>

                <!-- Botones de inicio de sesión y registro -->
                <div class="space-x-4">
                    <Link v-if="auth.user" href="/dashboard"
                        class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 flex items-center justify-center gap-2">
                    <FontAwesomeIcon :icon="faTachometerAlt" />
                    Ir al Dashboard
                    </Link>

                    <template>
                        <Link :href="route('login')"
                            class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 flex items-center justify-center gap-2">
                        <FontAwesomeIcon :icon="faSignInAlt" />
                        Ingresar
                        </Link>

                        <Link :href="route('register')"
                            class="ml-4 bg-green-600 text-white px-6 py-2 rounded-full hover:bg-green-700 flex items-center justify-center gap-2">
                        <FontAwesomeIcon :icon="faUserPlus" />
                        Registrarse
                        </Link>
                    </template>
                </div>
                <Link :href="route('register')"
                            class="ml-4 bg-green-600 text-white px-6 py-2 rounded-full hover:bg-green-700 flex items-center justify-center gap-2">
                        <FontAwesomeIcon :icon="faUserPlus" />
                        Registrarse 
                        </Link>
                <!-- Enlace para explorar sin iniciar sesión -->
                <div v-if="!auth.user" class="mt-8">
                    <Link :href="route('dashboard')"
                        class="bg-gray-800 text-white px-6 py-2 rounded-full hover:bg-gray-900 flex items-center justify-center gap-2">
                    <FontAwesomeIcon :icon="faCompass" />
                    INGRESA y Encuentra y recomienda clasicones.
                    </Link>
                </div>
            </div>

            <!-- Sección de recomendaciones -->
            <div class="w-full md:w-1/3 p-6 bg-gray-800 dark:bg-gray-900 rounded-lg shadow-lg h-[75vh] flex flex-col">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-semibold text-white">Clasicones de hoy</h2>
                    <button @click="shuffleRecommendations" class="text-white hover:text-gray-400">
                        <FontAwesomeIcon :icon="faSyncAlt" />
                    </button>
                </div>
                <div class="space-y-4 overflow-y-auto">
                    <div v-for="recommendation in recommendations" :key="recommendation.id"
                        class="flex items-center bg-gray-700 dark:bg-gray-800 rounded-lg p-4">
                        <img :src="recommendation.image" alt="Recommendation Image"
                            class="w-22 h-28 object-cover rounded-md mr-4">
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-white">{{ recommendation.title }}</h3>
                            <p class="text-sm text-gray-300">"{{ recommendation.description }}"</p>
                            <p class="text-xs text-gray-400 flex items-center gap-1">
                                <FontAwesomeIcon :icon="faUser" /> {{ recommendation.user }}
                            </p>
                            <span class="inline-block bg-blue-500 text-white text-xs px-2 py-1 mt-2 rounded">{{
                                recommendation.category }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer con información adicional -->
        <footer class="absolute bottom-0 w-full text-center py-4 bg-black bg-opacity-60 text-gray-300">
            <p>&copy; 2024 Clasicón. Todos los derechos reservados.</p>
            <!-- <p>Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})</p> -->
        </footer>
    </div>
</template>