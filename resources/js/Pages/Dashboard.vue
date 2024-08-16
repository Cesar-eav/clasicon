<script setup>
import { ref, computed } from 'vue'; // Importa ref y computed correctamente
import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { usePage } from '@inertiajs/vue3';
import { faSyncAlt, faUser, faBook, faFilm, faGamepad, faTv, faMusic, faPaperPlane } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import axios from 'axios';

const user = usePage().props.auth.user;
const postContent = ref('');
const recommendations = ref({
    books: [],
    movies: [],
    games: [],
    series: [],
    music: []
});

// Estado para la categoría seleccionada
const selectedCategory = ref(''); // Asegurarse de que selectedCategory esté correctamente inicializado como string vacío

// Función para manejar la publicación de contenido
const postRecommendation = async () => {
    if (postContent.value.trim() !== '') {
        try {
            postContent.value = '';
            alert('Publicación exitosa');
        } catch (error) {
            console.error('Error posting recommendation:', error);
            alert('Error al publicar, por favor intenta de nuevo.');
        }
    } else {
        alert('No puedes publicar un contenido vacío.');
    }
};

// Función para obtener recomendaciones aleatorias por categoría
const fetchCategoryRecommendations = async (categoryName) => {
    try {
        const response = await axios.get(`/api/recommendations/random?category=${categoryName}`);
        let recommendationsArray = [];

        if (Array.isArray(response.data[categoryName])) {
            recommendationsArray = response.data[categoryName];
        } else {
            console.error(`The object does not contain an array for category: ${categoryName}`);
        }

        if (recommendationsArray.length > 0) {
            recommendations.value = {
                ...recommendations.value,
                [categoryName]: recommendationsArray
            };
        } else {
            console.warn(`No valid recommendations found for category: ${categoryName}`);
        }
    } catch (error) {
        console.error(`Error fetching recommendations for category: ${categoryName}`, error);
    }
};

// Llama a la función para obtener recomendaciones cuando se carga la página
const fetchRecommendations = async () => {
    const response = await axios.get('/api/recommendations/random');
    recommendations.value = response.data;
};

fetchRecommendations();

// Función para obtener el ícono adecuado para cada categoría
const getCategoryIcon = (categoryName) => {
    const icons = {
        books: faBook,
        movies: faFilm,
        games: faGamepad,
        series: faTv,
        music: faMusic
    };
    return icons[categoryName] || faBook;
};
const postsPerPage = 20; // Número de posteos a cargar por página
const loadedPosts = ref(postsPerPage); // Cantidad de posteos actualmente cargados
const observerTarget = ref(null); // Referencia al último elemento visible


const loadMorePosts = () => {
    if (loadedPosts.value < simulatedPosts.value.length) {
        loadedPosts.value += postsPerPage;
    }
};

const observer = new IntersectionObserver((entries) => {
    if (entries[0].isIntersecting) {
        loadMorePosts();
    }
}, {
    root: null, // Usa el viewport como el contenedor
    threshold: 0.1 // Umbral de intersección
});

// watchEffect(() => {
//     if (observerTarget.value) {
//         observer.observe(observerTarget);
//     }
// });



// Función para traducir las categorías si es necesario
const translateCategory = (categoryName) => {
    const translations = {
        books: 'Libros',
        movies: 'Películas',
        games: 'Juegos',
        series: 'Series',
        music: 'Música'
    };
    return translations[categoryName] || categoryName;
};

// Simulación de posteos de otros usuarios
const simulatedPosts = ref([
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
        user: 'Kenia Bell',
        title: 'The Miseducation',
        category: 'música',
        description: 'De los mejores discos de la história de la música.',
        image: '/storage/images/discos/the_miseducationjpeg.jpeg',
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
        image: '/storage/images/discos/the_miseducation.jpeg',
    },
    {
        user: 'Mark Times',
        title: 'Abbey Road - The Beatles',
        category: 'música',
        description: '¡Es un clásico atemporal! Las melodías, las letras... simplemente todo. No hay una canción en este álbum que no sea increíble.',
        image: '/storage/images/discos/abbey_road.jpeg',
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
        image: '/storage/images/discos/dark_side_of_the_moon.jpeg',
    },
    {
        user: 'Luis Ramírez',
        title: 'Rumours - Fleetwood Mac',
        category: 'música',
        description: 'Uno de los álbumes más icónicos de los 70. Las armonías, las letras, todo es simplemente mágico.',
        image: '/storage/images/discos/rumours.jpeg',
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

// Filtrar posteos simulados por categoría
const filteredPosts = computed(() => {
    console.log('Selected Category:', selectedCategory.value); // Para verificar el valor de selectedCategory
    if (selectedCategory.value) {
        // Filtrar los posts simulados en base a la categoría seleccionada
        return simulatedPosts.value.filter(post => post.category.toLowerCase() === selectedCategory.value.toLowerCase());
    }
    // Si no hay categoría seleccionada, devolver todos los posts
    return simulatedPosts.value;
});
</script>

<template>
    <AuthenticatedLayout title="Bienvenido a Clasicon.cl">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between p-2">
                <h2 class="text-xl font-semibold leading-tight">
                    Bienvenido, {{ user.name }}
                </h2>
            </div>
        </template>
        
        <!-- Contenido principal -->
        <div class="p-6 bg-white dark:bg-gray-800 rounded-md shadow-md flex justify-between">
            <div class="w-full max-w-2xl">
                <!-- Filtros de categorías -->
                <div class="flex justify-around mb-4">
    <div class="flex flex-col items-center cursor-pointer" @click="selectedCategory = 'libro'">
        <FontAwesomeIcon :icon="faBook" class="text-gray-400 text-2xl hover:text-blue-500" />
        <span class="text-sm text-gray-600 dark:text-gray-400">Libros</span>
    </div>
    <div class="flex flex-col items-center cursor-pointer" @click="selectedCategory = 'película'">
        <FontAwesomeIcon :icon="faFilm" class="text-gray-400 text-2xl hover:text-blue-500" />
        <span class="text-sm text-gray-600 dark:text-gray-400">Películas</span>
    </div>
    <div class="flex flex-col items-center cursor-pointer" @click="selectedCategory = 'serie'">
        <FontAwesomeIcon :icon="faTv" class="text-gray-400 text-2xl hover:text-blue-500" />
        <span class="text-sm text-gray-600 dark:text-gray-400">Series</span>
    </div>
    <div class="flex flex-col items-center cursor-pointer" @click="selectedCategory = 'game'">
        <FontAwesomeIcon :icon="faGamepad" class="text-gray-400 text-2xl hover:text-blue-500" />
        <span class="text-sm text-gray-600 dark:text-gray-400">Juegos</span>
    </div>
    <div class="flex flex-col items-center cursor-pointer" @click="selectedCategory = 'música'">
        <FontAwesomeIcon :icon="faMusic" class="text-gray-400 text-2xl hover:text-blue-500" />
        <span class="text-sm text-gray-600 dark:text-gray-400">Música</span>
    </div>
</div>


                <!-- Simulación de posteos de otros usuarios -->
                <h3 class="text-lg font-semibold mb-4">Los clasicones</h3>
                <div v-for="(post, index) in filteredPosts" :key="index" class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md mb-6 flex">
                    <img :src="post.image" alt="Recommendation Image" class="w-24 h-32 object-cover rounded-md mr-4">
                    <div>
                        <div class="flex items-center">
                            <FontAwesomeIcon
                                :icon="getCategoryIcon(post.category)"
                                class="mr-2 text-gray-400"
                            />
                            <h4 class="text-md font-bold text-gray-800 dark:text-gray-300">{{ post.title }}</h4>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">"{{ post.description }}"</p>
                        <div class="text-sm text-gray-800 dark:text-gray-300">
                            <div class="flex items-center">
                                <FontAwesomeIcon :icon="faUser" class="mr-2" />
                                <span>{{ post.user }}</span>
                            </div>
                            <button class="mt-2 bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded text-sm">Seguir</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Columnas de categorías en la derecha -->
            <div class="w-1/4 sticky top-0 h-screen overflow-y-auto">
                <div v-for="(category, categoryName) in recommendations" :key="categoryName" class="mb-6">
                    <div class="flex items-center justify-between p-4 rounded-lg shadow-lg mb-4 border border-black bg-transparent">
                        <!-- Icono y categoría -->
                        <div class="flex items-center">
                            <FontAwesomeIcon :icon="getCategoryIcon(categoryName)" class="mr-2" />
                            <h3 class="text-lg font-semibold capitalize">{{ translateCategory(categoryName) }}</h3>
                        </div>
                        <!-- Botón de actualizar -->
                        <button @click="fetchCategoryRecommendations(categoryName)" class="text-sm text-white p-2 rounded-full bg-blue-500 hover:bg-blue-400">
                            <FontAwesomeIcon :icon="faSyncAlt" />
                        </button>
                    </div>
                    <div class="bg-gray-900 p-3 rounded-md shadow-md">
                        <div v-if="Array.isArray(category)" v-for="recommendation in category.slice(0, 3)" :key="recommendation.id" class="mb-4">
                            <h4 class="text-md font-bold text-white">{{ recommendation.title }}</h4>
                            <p class="text-sm text-gray-300">{{ recommendation.description }}</p>
                            <div class="flex items-center text-sm text-gray-400">
                                <FontAwesomeIcon :icon="faUser" class="mr-2" />
                                <span>{{ recommendation.user }}</span>
                            </div>
                        </div>
                        <div v-else>
                            <p class="text-sm text-gray-500">No hay recomendaciones disponibles.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
