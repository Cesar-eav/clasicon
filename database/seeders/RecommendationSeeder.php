<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recommendation;
use Illuminate\Support\Str;

class RecommendationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recommendations = [
            [
                'title' => 'Dune',
                'description' => 'Dune es una obra maestra de la ciencia ficción que te transporta a un desierto galáctico donde la especia melange es la sustancia más valiosa del universo. Este épico relato de poder, traición y supervivencia es imperdible para los amantes del género.',
                'tags' => json_encode(['space', 'future', 'politics', 'ecology', 'empire']),
                'category' => 'book',
                'user_id' => rand(1, 11),
            ],
            [
                'title' => 'Neuromante',
                'description' => 'Considerado el libro que inició el subgénero del cyberpunk, Neuromante te sumerge en un mundo de hackers, inteligencia artificial y megacorporaciones que controlan el futuro. Una historia vibrante y visionaria que sigue siendo relevante hoy en día.',
                'tags' => json_encode(['technology', 'cyberpunk', 'AI', 'virtual reality', 'dystopia']),
                'category' => 'book',
                'user_id' => rand(1, 11),
            ],
            [
                'title' => 'Fahrenheit 451',
                'description' => 'En una sociedad donde los libros están prohibidos y son quemados, un bombero comienza a cuestionar su misión. Fahrenheit 451 es una profunda reflexión sobre la censura y la importancia de la libertad intelectual.',
                'tags' => json_encode(['dystopia', 'censorship', 'freedom', 'firemen', 'totalitarianism']),
                'category' => 'book',
                'user_id' => rand(1, 11),
            ],
            [
                'title' => 'La mano izquierda de la oscuridad',
                'description' => 'Ursula K. Le Guin nos lleva a un planeta frío donde los habitantes pueden cambiar de género. A través de esta historia, Le Guin explora la dualidad de género y el entendimiento cultural, desafiando las normas de la ciencia ficción.',
                'tags' => json_encode(['gender', 'alien worlds', 'culture', 'identity', 'psychology']),
                'category' => 'book',
                'user_id' => rand(1, 11),
            ],
            [
                'title' => 'El juego de Ender',
                'description' => 'En un futuro donde la humanidad está en guerra con una especie alienígena, un niño genio es entrenado para convertirse en el comandante militar que podría salvar a la Tierra. El juego de Ender es una emocionante aventura que explora el liderazgo, la moralidad y la estrategia.',
                'tags' => json_encode(['war', 'strategy', 'children', 'aliens', 'leadership']),
                'category' => 'book',
                'user_id' => rand(1, 11),
            ],
            // Novelas Históricas
            [
                'title' => 'Guerra y Paz',
                'description' => 'Una de las novelas más grandiosas jamás escritas, Guerra y Paz narra la historia de cinco familias aristocráticas rusas durante la invasión napoleónica de Rusia. Tolstói mezcla ficción con historia real para ofrecer un retrato profundo de la vida y la guerra.',
                'tags' => json_encode(['war', 'russia', 'napoleon', 'aristocracy', 'history']),
                'category' => 'book',
                'user_id' => rand(1, 11),
            ],
            [
                'title' => 'El nombre de la rosa',
                'description' => 'En la Italia medieval, un monje franciscano y su aprendiz investigan una serie de misteriosos asesinatos en una abadía. El nombre de la rosa combina historia, misterio y filosofía en una novela que ha cautivado a lectores de todo el mundo.',
                'tags' => json_encode(['medieval', 'mystery', 'religion', 'philosophy', 'detective']),
                'category' => 'book',
                'user_id' => rand(1, 11),
            ],
            [
                'title' => 'Los pilares de la tierra',
                'description' => 'Ken Follett nos transporta a la Inglaterra del siglo XII, en una historia épica de ambición, amor y venganza centrada en la construcción de una catedral. Los pilares de la tierra es una obra maestra de la narrativa histórica.',
                'tags' => json_encode(['medieval', 'architecture', 'love', 'revenge', 'church']),
                'category' => 'book',
                'user_id' => rand(1, 11),
            ],
            [
                'title' => 'Yo, Claudio',
                'description' => 'Robert Graves recrea la vida de uno de los emperadores más intrigantes de Roma, Claudio, en una novela histórica narrada desde la perspectiva del propio emperador. Yo, Claudio es un relato fascinante de intriga, poder y supervivencia en la antigua Roma.',
                'tags' => json_encode(['rome', 'emperor', 'power', 'survival', 'intrigue']),
                'category' => 'book',
                'user_id' => rand(1, 11),
            ],
            [
                'title' => 'El puente de Alcántara',
                'description' => 'Este relato histórico sigue la vida de varios personajes a lo largo de la historia de España, centrado en el puente romano de Alcántara. La novela explora temas de identidad, conflicto y la herencia cultural a lo largo de los siglos.',
                'tags' => json_encode(['spain', 'rome', 'identity', 'conflict', 'heritage']),
                'category' => 'book',
                'user_id' => rand(1, 11),
            ],
            // Ciencia Política
            [
                'title' => 'El Príncipe',
                'description' => 'Escrito por Nicolás Maquiavelo, El Príncipe es uno de los tratados políticos más influyentes de la historia. Este libro ofrece una visión pragmática del poder, la política y el liderazgo, y sigue siendo relevante en la política contemporánea.',
                'tags' => json_encode(['power', 'leadership', 'strategy', 'politics', 'realism']),
                'category' => 'book',
                'user_id' => rand(1, 11),
            ],
            [
                'title' => 'Los orígenes del totalitarismo',
                'description' => 'Hannah Arendt analiza en profundidad los regímenes totalitarios que surgieron en el siglo XX. Este libro es una obra clave para comprender los mecanismos de poder y opresión en las sociedades modernas.',
                'tags' => json_encode(['totalitarianism', 'oppression', 'politics', 'society', 'history']),
                'category' => 'book',
                'user_id' => rand(1, 11),
            ],
            [
                'title' => 'El contrato social',
                'description' => 'Jean-Jacques Rousseau examina la idea del contrato social, una de las bases de la teoría política moderna. Este libro sigue siendo fundamental para entender la relación entre el individuo y el Estado.',
                'tags' => json_encode(['society', 'state', 'freedom', 'rights', 'politics']),
                'category' => 'book',
                'user_id' => rand(1, 11),
            ],
            [
                'title' => 'La democracia en América',
                'description' => 'Alexis de Tocqueville ofrece un análisis detallado de la joven democracia estadounidense en el siglo XIX. Su obra es considerada una de las mejores evaluaciones de la democracia y sigue siendo un referente en la ciencia política.',
                'tags' => json_encode(['democracy', 'america', 'society', 'politics', 'history']),
                'category' => 'book',
                'user_id' => rand(1, 11),
            ],
            [
                'title' => 'El choque de civilizaciones',
                'description' => 'Samuel P. Huntington plantea la teoría de que los futuros conflictos globales serán entre culturas y civilizaciones más que entre naciones. Este libro es esencial para entender la dinámica política y cultural del mundo contemporáneo.',
                'tags' => json_encode(['civilization', 'conflict', 'culture', 'politics', 'global']),
                'category' => 'book',
                'user_id' => rand(1, 11),
            ],
            // Sociología
            [
                'title' => 'La sociedad del riesgo',
                'description' => 'Ulrich Beck analiza cómo la modernidad avanzada ha creado nuevos tipos de riesgos globales, desde el cambio climático hasta la globalización económica. Este libro es una lectura obligada para aquellos interesados en la sociología contemporánea.',
                'tags' => json_encode(['risk', 'society', 'modernity', 'globalization', 'environment']),
                'category' => 'book',
                'user_id' => rand(1, 11),
            ],
            [
                'title' => 'Vigilancia líquida',
                'description' => 'Zygmunt Bauman explora cómo la vigilancia se ha convertido en un aspecto central de la vida moderna, con las tecnologías que permiten el seguimiento constante de los individuos. Una obra profunda sobre la privacidad en la era digital.',
                'tags' => json_encode(['surveillance', 'privacy', 'technology', 'modernity', 'society']),
                'category' => 'book',
                'user_id' => rand(1, 11),
            ],
            [
                'title' => 'El suicidio',
                'description' => 'Émile Durkheim realiza un estudio sociológico sobre el suicidio, considerándolo como un hecho social más que un acto individual. Este libro es fundamental para entender cómo las estructuras sociales influyen en el comportamiento individual.',
                'tags' => json_encode(['suicide', 'society', 'behavior', 'social structures', 'sociology']),
                'category' => 'book',
                'user_id' => rand(1, 11),
            ],
            [
                'title' => 'La ética protestante y el espíritu del capitalismo',
                'description' => 'Max Weber investiga cómo las ideas religiosas del protestantismo influyeron en el desarrollo del capitalismo. Una obra clásica que explora la relación entre religión, economía y sociedad.',
                'tags' => json_encode(['religion', 'capitalism', 'economy', 'society', 'ethics']),
                'category' => 'book',
                'user_id' => rand(1, 11),
            ],
            [
                'title' => 'Distinción: Una crítica social del juicio del gusto',
                'description' => 'Pierre Bourdieu examina cómo las preferencias culturales están relacionadas con las estructuras sociales y el poder. Distinción es una obra clave para entender la estratificación social y el poder en las sociedades modernas.',
                'tags' => json_encode(['culture', 'taste', 'power', 'society', 'social stratification']),
                'category' => 'book',
                'user_id' => rand(1, 11),
            ],
            // Antropología
            [
                'title' => 'Los argonautas del Pacífico Occidental',
                'description' => 'Bronisław Malinowski es uno de los padres de la antropología moderna, y en este libro, explora la vida de los habitantes de las islas Trobriand. Su enfoque participativo y detallado cambió la forma en que se hace investigación antropológica.',
                'tags' => json_encode(['anthropology', 'fieldwork', 'culture', 'islands', 'tradition']),
                'category' => 'book',
                'user_id' => rand(1, 11),
            ],
            [
                'title' => 'Tristes trópicos',
                'description' => 'Claude Lévi-Strauss relata sus experiencias y reflexiones durante sus viajes por América del Sur. Tristes trópicos es una combinación de autobiografía, etnografía y crítica cultural, considerada una obra maestra de la antropología.',
                'tags' => json_encode(['ethnography', 'south america', 'culture', 'travel', 'autobiography']),
                'category' => 'book',
                'user_id' => rand(1, 11),
            ],
            [
                'title' => 'Totem y tabú',
                'description' => 'Sigmund Freud explora las similitudes entre las prácticas de las culturas primitivas y los comportamientos de los individuos modernos. Este libro es una mezcla de antropología y psicoanálisis que ofrece una visión única de la humanidad.',
                'tags' => json_encode(['totemism', 'taboo', 'psychoanalysis', 'culture', 'society']),
                'category' => 'book',
                'user_id' => rand(1, 11),
            ],
            [
                'title' => 'El antropólogo inocente',
                'description' => 'Nigel Barley narra con humor sus experiencias como antropólogo novato en Camerún. Este libro es una divertida e informativa mirada a los desafíos y sorpresas de la investigación de campo en antropología.',
                'tags' => json_encode(['fieldwork', 'humor', 'africa', 'culture', 'anthropology']),
                'category' => 'book',
                'user_id' => rand(1, 11),
            ],
            [
                'title' => 'Patterns of Culture',
                'description' => 'Ruth Benedict presenta un análisis comparativo de tres culturas diferentes, argumentando que cada cultura es un "patrón" coherente y distintivo. Este libro es fundamental para entender cómo la cultura influye en la personalidad y el comportamiento.',
                'tags' => json_encode(['culture', 'behavior', 'personality', 'comparative study', 'anthropology']),
                'category' => 'book',
                'user_id' => rand(1, 11),
            ],
            // Otros temas
            [
                'title' => 'El origen de las especies',
                'description' => 'Charles Darwin revolucionó la ciencia con su teoría de la evolución. En El origen de las especies, Darwin argumenta cómo la selección natural ha guiado la evolución de la vida en la Tierra. Una obra esencial para cualquier interesado en la biología y la evolución.',
                'tags' => json_encode(['evolution', 'biology', 'natural selection', 'science', 'history']),
                'category' => 'book',
                'user_id' => rand(1, 11),
            ],
            [
                'title' => 'La riqueza de las naciones',
                'description' => 'Adam Smith es considerado el padre de la economía moderna, y en La riqueza de las naciones, explora los principios del libre mercado y la división del trabajo. Este libro es un pilar de la teoría económica clásica.',
                'tags' => json_encode(['economy', 'market', 'wealth', 'labor', 'economics']),
                'category' => 'book',
                'user_id' => rand(1, 11),
            ],
            [
                'title' => 'La república',
                'description' => 'En La república, Platón presenta su visión de una sociedad ideal gobernada por filósofos-reyes. Este diálogo filosófico aborda temas como la justicia, la política y la naturaleza del conocimiento, y es una obra central en la filosofía occidental.',
                'tags' => json_encode(['philosophy', 'justice', 'society', 'politics', 'knowledge']),
                'category' => 'book',
                'user_id' => rand(1, 11),
            ],
            [
                'title' => 'El capital',
                'description' => 'Karl Marx analiza las estructuras económicas del capitalismo en El capital. Este libro ha tenido un impacto profundo en la política, la economía y la sociología, y sigue siendo una lectura esencial para entender las dinámicas del poder económico.',
                'tags' => json_encode(['capitalism', 'economics', 'labor', 'power', 'society']),
                'category' => 'book',
                'user_id' => rand(1, 11),
            ],
            [
                'title' => 'Homo Sapiens: Breve historia de la humanidad',
                'description' => 'Yuval Noah Harari ofrece una fascinante narrativa de la historia de la humanidad, desde el surgimiento del Homo sapiens hasta las revoluciones tecnológicas modernas. Este libro es una mezcla de historia, ciencia y filosofía, y ha capturado la imaginación de millones de lectores.',
                'tags' => json_encode(['history', 'humanity', 'evolution', 'technology', 'philosophy']),
                'category' => 'book',
                'user_id' => rand(1, 11),
            ],
        ];
        
        // Insertar todas las recomendaciones en la base de datos
        foreach ($recommendations as $recommendation) {
            Recommendation::create($recommendation);
        }
    }
}
