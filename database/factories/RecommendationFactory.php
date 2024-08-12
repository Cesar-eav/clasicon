<?php

namespace Database\Factories;

use App\Models\Recommendation;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecommendationFactory extends Factory
{
    protected $model = Recommendation::class;

    // Contador para alternar entre user_id = 1 y user_id = 2
    protected static $userIdCounter = 1;

    public function definition()
    {
        $books = [
            // Ciencia Ficción
            [
                'title' => 'Dune',
                'description' => 'Dune es una obra maestra de la ciencia ficción que te transporta a un desierto galáctico donde la especia melange es la sustancia más valiosa del universo. Este épico relato de poder, traición y supervivencia es imperdible para los amantes del género.',
                'tags' => ['space', 'future', 'politics', 'ecology', 'empire'],
            ],
            [
                'title' => 'Neuromante',
                'description' => 'Considerado el libro que inició el subgénero del cyberpunk, Neuromante te sumerge en un mundo de hackers, inteligencia artificial y megacorporaciones que controlan el futuro. Una historia vibrante y visionaria que sigue siendo relevante hoy en día.',
                'tags' => ['technology', 'cyberpunk', 'AI', 'virtual reality', 'dystopia'],
            ],
            [
                'title' => 'Fahrenheit 451',
                'description' => 'En una sociedad donde los libros están prohibidos y son quemados, un bombero comienza a cuestionar su misión. Fahrenheit 451 es una profunda reflexión sobre la censura y la importancia de la libertad intelectual.',
                'tags' => ['dystopia', 'censorship', 'freedom', 'firemen', 'totalitarianism'],
            ],
            [
                'title' => 'La mano izquierda de la oscuridad',
                'description' => 'Ursula K. Le Guin nos lleva a un planeta frío donde los habitantes pueden cambiar de género. A través de esta historia, Le Guin explora la dualidad de género y el entendimiento cultural, desafiando las normas de la ciencia ficción.',
                'tags' => ['gender', 'alien worlds', 'culture', 'identity', 'psychology'],
            ],
            [
                'title' => 'El juego de Ender',
                'description' => 'En un futuro donde la humanidad está en guerra con una especie alienígena, un niño genio es entrenado para convertirse en el comandante militar que podría salvar a la Tierra. El juego de Ender es una emocionante aventura que explora el liderazgo, la moralidad y la estrategia.',
                'tags' => ['war', 'strategy', 'children', 'aliens', 'leadership'],
            ],
            // Novelas Históricas
            [
                'title' => 'Guerra y Paz',
                'description' => 'Una de las novelas más grandiosas jamás escritas, Guerra y Paz narra la historia de cinco familias aristocráticas rusas durante la invasión napoleónica de Rusia. Tolstói mezcla ficción con historia real para ofrecer un retrato profundo de la vida y la guerra.',
                'tags' => ['war', 'russia', 'napoleon', 'aristocracy', 'history'],
            ],
            [
                'title' => 'El nombre de la rosa',
                'description' => 'En la Italia medieval, un monje franciscano y su aprendiz investigan una serie de misteriosos asesinatos en una abadía. El nombre de la rosa combina historia, misterio y filosofía en una novela que ha cautivado a lectores de todo el mundo.',
                'tags' => ['medieval', 'mystery', 'religion', 'philosophy', 'detective'],
            ],
            [
                'title' => 'Los pilares de la tierra',
                'description' => 'Ken Follett nos transporta a la Inglaterra del siglo XII, en una historia épica de ambición, amor y venganza centrada en la construcción de una catedral. Los pilares de la tierra es una obra maestra de la narrativa histórica.',
                'tags' => ['medieval', 'architecture', 'love', 'revenge', 'church'],
            ],
            [
                'title' => 'Yo, Claudio',
                'description' => 'Robert Graves recrea la vida de uno de los emperadores más intrigantes de Roma, Claudio, en una novela histórica narrada desde la perspectiva del propio emperador. Yo, Claudio es un relato fascinante de intriga, poder y supervivencia en la antigua Roma.',
                'tags' => ['rome', 'emperor', 'power', 'survival', 'intrigue'],
            ],
            [
                'title' => 'El puente de Alcántara',
                'description' => 'Este relato histórico sigue la vida de varios personajes a lo largo de la historia de España, centrado en el puente romano de Alcántara. La novela explora temas de identidad, conflicto y la herencia cultural a lo largo de los siglos.',
                'tags' => ['spain', 'rome', 'identity', 'conflict', 'heritage'],
            ],
            // Ciencia Política
            [
                'title' => 'El Príncipe',
                'description' => 'Escrito por Nicolás Maquiavelo, El Príncipe es uno de los tratados políticos más influyentes de la historia. Este libro ofrece una visión pragmática del poder, la política y el liderazgo, y sigue siendo relevante en la política contemporánea.',
                'tags' => ['power', 'leadership', 'strategy', 'politics', 'realism'],
            ],
            [
                'title' => 'Los orígenes del totalitarismo',
                'description' => 'Hannah Arendt analiza en profundidad los regímenes totalitarios que surgieron en el siglo XX. Este libro es una obra clave para comprender los mecanismos de poder y opresión en las sociedades modernas.',
                'tags' => ['totalitarianism', 'oppression', 'politics', 'society', 'history'],
            ],
            [
                'title' => 'El contrato social',
                'description' => 'Jean-Jacques Rousseau examina la idea del contrato social, una de las bases de la teoría política moderna. Este libro sigue siendo fundamental para entender la relación entre el individuo y el Estado.',
                'tags' => ['society', 'state', 'freedom', 'rights', 'politics'],
            ],
            [
                'title' => 'La democracia en América',
                'description' => 'Alexis de Tocqueville ofrece un análisis detallado de la joven democracia estadounidense en el siglo XIX. Su obra es considerada una de las mejores evaluaciones de la democracia y sigue siendo un referente en la ciencia política.',
                'tags' => ['democracy', 'america', 'society', 'politics', 'history'],
            ],
            [
                'title' => 'El choque de civilizaciones',
                'description' => 'Samuel P. Huntington plantea la teoría de que los futuros conflictos globales serán entre culturas y civilizaciones más que entre naciones. Este libro es esencial para entender la dinámica política y cultural del mundo contemporáneo.',
                'tags' => ['civilization', 'conflict', 'culture', 'politics', 'global'],
            ],
            // Sociología
            [
                'title' => 'La sociedad del riesgo',
                'description' => 'Ulrich Beck analiza cómo la modernidad avanzada ha creado nuevos tipos de riesgos globales, desde el cambio climático hasta la globalización económica. Este libro es una lectura obligada para aquellos interesados en la sociología contemporánea.',
                'tags' => ['risk', 'society', 'modernity', 'globalization', 'environment'],
            ],
            [
                'title' => 'Vigilancia líquida',
                'description' => 'Zygmunt Bauman explora cómo la vigilancia se ha convertido en un aspecto central de la vida moderna, con las tecnologías que permiten el seguimiento constante de los individuos. Una obra profunda sobre la privacidad en la era digital.',
                'tags' => ['surveillance', 'privacy', 'technology', 'modernity', 'society'],
            ],
            [
                'title' => 'El suicidio',
                'description' => 'Émile Durkheim realiza un estudio sociológico sobre el suicidio, considerándolo como un hecho social más que un acto individual. Este libro es fundamental para entender cómo las estructuras sociales influyen en el comportamiento individual.',
                'tags' => ['suicide', 'society', 'behavior', 'social structures', 'sociology'],
            ],
            [
                'title' => 'La ética protestante y el espíritu del capitalismo',
                'description' => 'Max Weber investiga cómo las ideas religiosas del protestantismo influyeron en el desarrollo del capitalismo. Una obra clásica que explora la relación entre religión, economía y sociedad.',
                'tags' => ['religion', 'capitalism', 'economy', 'society', 'ethics'],
            ],
            [
                'title' => 'Distinción: Una crítica social del juicio del gusto',
                'description' => 'Pierre Bourdieu examina cómo las preferencias culturales están relacionadas con las estructuras sociales y el poder. Distinción es una obra clave para entender la estratificación social y el poder en las sociedades modernas.',
                'tags' => ['culture', 'taste', 'power', 'society', 'social stratification'],
            ],
            // Antropología
            [
                'title' => 'Los argonautas del Pacífico Occidental',
                'description' => 'Bronisław Malinowski es uno de los padres de la antropología moderna, y en este libro, explora la vida de los habitantes de las islas Trobriand. Su enfoque participativo y detallado cambió la forma en que se hace investigación antropológica.',
                'tags' => ['anthropology', 'fieldwork', 'culture', 'islands', 'tradition'],
            ],
            [
                'title' => 'Tristes trópicos',
                'description' => 'Claude Lévi-Strauss relata sus experiencias y reflexiones durante sus viajes por América del Sur. Tristes trópicos es una combinación de autobiografía, etnografía y crítica cultural, considerada una obra maestra de la antropología.',
                'tags' => ['ethnography', 'south america', 'culture', 'travel', 'autobiography'],
            ],
            [
                'title' => 'Totem y tabú',
                'description' => 'Sigmund Freud explora las similitudes entre las prácticas de las culturas primitivas y los comportamientos de los individuos modernos. Este libro es una mezcla de antropología y psicoanálisis que ofrece una visión única de la humanidad.',
                'tags' => ['totemism', 'taboo', 'psychoanalysis', 'culture', 'society'],
            ],
            [
                'title' => 'El antropólogo inocente',
                'description' => 'Nigel Barley narra con humor sus experiencias como antropólogo novato en Camerún. Este libro es una divertida e informativa mirada a los desafíos y sorpresas de la investigación de campo en antropología.',
                'tags' => ['fieldwork', 'humor', 'africa', 'culture', 'anthropology'],
            ],
            [
                'title' => 'Patterns of Culture',
                'description' => 'Ruth Benedict presenta un análisis comparativo de tres culturas diferentes, argumentando que cada cultura es un "patrón" coherente y distintivo. Este libro es fundamental para entender cómo la cultura influye en la personalidad y el comportamiento.',
                'tags' => ['culture', 'behavior', 'personality', 'comparative study', 'anthropology'],
            ],
            // Otros temas (para completar los 50)
            [
                'title' => 'El origen de las especies',
                'description' => 'Charles Darwin revolucionó la ciencia con su teoría de la evolución. En El origen de las especies, Darwin argumenta cómo la selección natural ha guiado la evolución de la vida en la Tierra. Una obra esencial para cualquier interesado en la biología y la evolución.',
                'tags' => ['evolution', 'biology', 'natural selection', 'science', 'history'],
            ],
            [
                'title' => 'La riqueza de las naciones',
                'description' => 'Adam Smith es considerado el padre de la economía moderna, y en La riqueza de las naciones, explora los principios del libre mercado y la división del trabajo. Este libro es un pilar de la teoría económica clásica.',
                'tags' => ['economy', 'market', 'wealth', 'labor', 'economics'],
            ],
            [
                'title' => 'La república',
                'description' => 'En La república, Platón presenta su visión de una sociedad ideal gobernada por filósofos-reyes. Este diálogo filosófico aborda temas como la justicia, la política y la naturaleza del conocimiento, y es una obra central en la filosofía occidental.',
                'tags' => ['philosophy', 'justice', 'society', 'politics', 'knowledge'],
            ],
            [
                'title' => 'El capital',
                'description' => 'Karl Marx analiza las estructuras económicas del capitalismo en El capital. Este libro ha tenido un impacto profundo en la política, la economía y la sociología, y sigue siendo una lectura esencial para entender las dinámicas del poder económico.',
                'tags' => ['capitalism', 'economics', 'labor', 'power', 'society'],
            ],
            [
                'title' => 'Homo Sapiens: Breve historia de la humanidad',
                'description' => 'Yuval Noah Harari ofrece una fascinante narrativa de la historia de la humanidad, desde el surgimiento del Homo sapiens hasta las revoluciones tecnológicas modernas. Este libro es una mezcla de historia, ciencia y filosofía, y ha capturado la imaginación de millones de lectores.',
                'tags' => ['history', 'humanity', 'evolution', 'technology', 'philosophy'],
            ],
        ];

        $book = $this->faker->randomElement($books);
        // Alterna entre user_id 1 y 2
        $userId = static::$userIdCounter;
        static::$userIdCounter = $userId === 1 ? 2 : 1;

        return [
            'user_id' => $userId, // Alterna entre 1 y 2
            'title' => $book['title'],
            'description' => $book['description'],
            'category' => 'book', // Categoría 'book' para todos estos libros
            'tags' => json_encode($book['tags']), // Convertir etiquetas a formato JSON
        ];
    }
}