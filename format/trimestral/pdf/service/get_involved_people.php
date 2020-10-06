<?php
session_start();

$link = $_POST['link'];

$involved_people = array(
    2 => array(
        'elaborated_by' => array(
            'name' => 'Vanessa Pérez Díaz',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Lic. Ma. Guadalupe Pineda Chávez',
            'position' => 'Directora de Carpetas de Investigación y Litigación'
        )
    ),
    3 => array(
        'elaborated_by' => array(
            'name' => 'Nicolasa Aparicio Silva',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Lic Oscar Miguel Acosta Rosas',
            'position' => 'Titular de la Unidad de Investigación y Persecución al Narcomenudeo de la Fiscalía Especializada para la Atención a Delitos de Alto Impacto'
        )
    ),
    5 => array(
        'elaborated_by' => array(
            'name' => 'Godínez Zarate José Luis',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Mtro. Alejandro Carrillo Ochoa',
            'position' => 'Fiscal Estatal anticorrupción'
        )
    ),
    6 => array(
        'elaborated_by' => array(
            'name' => 'Lic. Blanca Cristina Mendoza Mendoza',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Mtro. Mario Aurelio Tirado Rayón',
            'position' => 'Titular de la unidad de investigación y persecución de delitos cometidos a través de medios cibernéticos'
        )
    ),
    9 => array(
        'elaborated_by' => array(
            'name' => 'Ernesto Villalobos Mejía',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Mtro. José Jesús Reyes Mosqueda',
            'position' => 'Fiscal especializado en el Combate a los delitos contra el Ambiente y La Fauna'
        )
    ),
    10 => array(
        'elaborated_by' => array(
            'name' => 'Erika Olivares Pinto',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => '[Nombre, Cargo y Firma]',
            'position' => ''
        )
    ),
    14 => array(
        'elaborated_by' => array(
            'name' => 'Dilsa Melissa Varela Martínez',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Mtra. Isidra Marin Hernandez',
            'position' => 'Directora de Carpetas de Investigación'
        )
    ),
    15 => array(
        'elaborated_by' => array(
            'name' => 'Daniel Pulido Virrueta',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Lic armando Montero Juarez',
            'position' => 'Director de Litigación'
        )
    ),
    17 => array(
        'elaborated_by' => array(
            'name' => 'Antonio De  Jesús Pérez Echevarría',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'María Sandra Rodríguez Virelas',
            'position' => 'Agente del Ministerio Publico'
        )
    ),
    18 => array(
        'elaborated_by' => array(
            'name' => 'Antonio De  Jesús Pérez Echevarría',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Joel Alejandro Zuñiga Napoles',
            'position' => 'Agente del Ministerio Publico'
        )
    ),
    21 => array(
        'elaborated_by' => array(
            'name' => 'Lic. Pedro Xochipa Ríos',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Lic. Servando Eduardo Barrera Tafolla',
            'position' => ''
        )
    ),
    26 => array(
        'elaborated_by' => array(
            'name' => 'María Isabel López Mendoza',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Mtro. Jorge Alberto Camacho Delgado',
            'position' => 'Titular de la unidad de asuntos especiales de la fiscalia coordinadora'
        )
    ),
    27 => array(
        'elaborated_by' => array(
            'name' => 'Gema Michell León García',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'José Francisco Moreno Salgado',
            'position' => 'Director de la Unidad de Extinción de Dominio e Inteligencia Patrimonial y Financiera'
        )
    ),
    28 => array(
        'elaborated_by' => array(
            'name' => 'Berta Ambris Cruz',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Lic. Verónica Guzmán Perez',
            'position' => 'Fiscal de investigacion y persecucion del homicidio doloso contra la mujer y feminicidio'
        )
    ),
    29 => array(
        'elaborated_by' => array(
            'name' => 'Miryam Atziri Camacho López',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Lic. Francisco Mederos Cisneros',
            'position' => 'Titular de la Unidad de Robo Contra El Transporte de la Fiscalía Especializada para la Atención a Delitos de Alto Impacto'
        )
    ),
    30 => array(
        'elaborated_by' => array(
            'name' => 'Guadalupe Arreola Guillén',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Mtro. Nicolas Fernando Rojas López',
            'position' => 'Fiscal Especializado de Homicidio Doloso'
        )
    ),
    31 => array(
        'elaborated_by' => array(
            'name' => 'Sheila Lizbeth Garcia Perez',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'M. en D. Eduardo Agustín Gutiérrez Palacios',
            'position' => 'Titular de la unidad contra el robo de vehiculos'
        )
    ),
    37 => array(
        'elaborated_by' => array(
            'name' => 'Imelda Christiane Rosales Villaseñor',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Lic. Yahveth Pintor Velazquez',
            'position' => 'Directora de Acceso a la Justicia, Centro de Justicia Integral para las Mujeres'
        )
    ),
    38 => array(
        'elaborated_by' => array(
            'name' => 'Rocío Marisol Vázquez Soto',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Dr Felix López Rosales',
            'position' => 'Fiscal especializado para el delito de tortura, tratos crueles inhumanos o degradantes'
        )
    ),
    67 => array(
        'elaborated_by' => array(
            'name' => 'Honorio lopez ayala',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Mtra Marisol Moreno Alvarez',
            'position' => 'coordinadora del centro de mecanismos alternativo de solusion de controversias'
        )
    ),
    69 => array(
        'elaborated_by' => array(
            'name' => 'Erandi Nallely Pérez Muñoz',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Mtra Araceli Palomares Miranda',
            'position' => 'Fiscal especializada para la atencion del delito de violencia familiar y de género'
        )
    ),
    70 => array(
        'elaborated_by' => array(
            'name' => 'Mtra. América Yunuén Méndez Silva',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Mtra Janeth Martínez Mondragón',
            'position' => 'Fiscal especializada en materia de Derechos Humanos y Libertad de Expresión'
        )
    ),
    71 => array(
        'elaborated_by' => array(
            'name' => 'Lic. Santos Gomez Herrera',
            'position' => 'Director de Carpetas de investigación'
        ),
        'validated_by' => array(
            'name' => 'Mtro Xicotencatl Soria Macedo',
            'position' => 'Fiscal regional de Huetamo'
        )
    ),
    72 => array(
        'elaborated_by' => array(
            'name' => 'Mtro. José Carmen García Mendiola',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Mtra Janeth Martínez Mondragón',
            'position' => 'Fiscal especializada en materia de Derechos Humanos y Libertad de Expresión'
        )
    ),
    73 => array(
        'elaborated_by' => array(
            'name' => 'Lic. Marco Antonio Miguel Cano',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Mtra Janeth Martínez Mondragón',
            'position' => 'Fiscal especializada en materia de Derechos Humanos y Libertad de Expresión'
        )
    ),
    74 => array(
        'elaborated_by' => array(
            'name' => 'Lic. Karina Esquivel Gutiérrez',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Mtro. Rodrigo González Ramírez',
            'position' => 'Titular de la Unidad Especializada de Combate al Secuestro'
        )
    ),
    75 => array(
        'elaborated_by' => array(
            'name' => 'Erandi Nallely Pérez Muñoz',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Mtra Araceli Palomares Miranda',
            'position' => 'Fiscal especializadapara la atencion del delito de violencia familiar y de género'
        )
    ),
    76 => array(
        'elaborated_by' => array(
            'name' => 'Lic. Hugo Ambriz Carranza',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Mtro. Andrés Vieyra Castro',
            'position' => 'Director Regional de Carpetas de Investigacion'
        )
    ),
    77 => array(
        'elaborated_by' => array(
            'name' => 'Alejandra Espinoza Morales',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Lic. José Manuel Moreno Luna',
            'position' => 'Director de carpetas de investigación de la Fiscalía Regional de Zitácuaro'
        )
    ),
    78 => array(
        'elaborated_by' => array(
            'name' => 'Agustín Pallares Mendoza',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Mtro. Agustín Pallares Mendoza',
            'position' => 'Encargado del área de carpetas de investigación'
        )
    ),
    79 => array(
        'elaborated_by' => array(
            'name' => 'Mayra Guadalupe Garnica Sosa',
            'position' => ''
        ),
        'validated_by' => array(
            'name' => 'Lic Gerardo Marin',
            'position' => 'Director de carpetas de investigación de la Fiscalía Regional de Morelia'
        )
    )
);


$_SESSION['involved_people'] = $involved_people[$link];

echo json_encode($involved_people, JSON_FORCE_OBJECT);


?>
