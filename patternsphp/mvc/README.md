# MVC Pattern

MVC Pattern son las siglas de Model-View-Controller Pattern. Este patrón se usa para separar las preocupaciones de la aplicación.

- _Model_ - El modelo representa un objeto o JAVA POJO que lleva datos. También puede tener lógica para actualizar el controlador si sus datos cambian.

- _View_ - La vista representa la visualización de los datos que contiene el modelo.

- _Controller_ - El controlador actúa tanto en el modelo como en la vista. Controla el flujo de datos hacia el objeto del modelo y actualiza la vista cada vez que cambian los datos. Mantiene la vista y el modelo separados.

## Implementación

Vamos a crear un objeto Student que actúa como modelo. StudentView será una clase de vista que puede imprimir los detalles del alumno en la consola y StudentController es la clase controladora responsable de almacenar datos en el objeto Student y actualizar la vista StudentView en consecuencia.

MVCPatternDemo, nuestra clase de demostración, utilizará StudentController para demostrar el uso del patrón MVC.

![UML Diagram](mvc_pattern_uml_diagram.jpg)

## Paso 1

Crear Modelo.

> Student.php

```php
<?php

declare(strict_types=1);

class Student
{
    private $_rollNo;
    private $_name;

    public function getRollNo(): string
    {
        return $this->_rollNo;
    }

    public function setRollNo(string $RollNo): void
    {
        $this->_rollNo = $RollNo;
    }

    public function getName(): string
    {
        return $this->_name;
    }

    public function setName(string $name): void
    {
        $this->_name = $name;
    }
}
```

## Paso 2

Crear vista.

> StudentView.php

```php
<?php

declare(strict_types=1);

class StudentView
{
    public function printStudentDetails(string $studentName, string $studentRollNo): void
    {
        print("Student: ");
        print sprintf("Name: %s", $studentName);
        print sprintf("Roll No: %s", $studentRollNo);
    }
}
```

## Paso 3

Crear Controlador.

> StudentController.php

```php
<?php

declare(strict_types=1);

class StudentController
{
    private $_studentModel;
    private $_studentView;

    public function __construct(Student $model, StudentView $view)
    {
        $this->_studentModel = $model;
        $this->_studentView = $view;
    }

    public function setStudentName(string $name): void
    {
        $this->_studentModel->setName($name);
    }

    public function getStudentName(): string
    {
        return $this->_studentModel->getName();
    }

    public function setStudentRollNo(string $rollNo): void
    {
        $this->_studentModel->setRollNo($rollNo);
    }

    public function getStudentRollNo(): string
    {
        return $this->_studentModel->getRollNo();
    }

    public function updateView(): void
    {
        $this->_studentView->printStudentDetails($this->_studentModel->getName(), $this->_studentModel->getRollNo());
    }
}
```

## Paso 4

Utilice los métodos StudentController para demostrar el uso del patrón de diseño MVC.

> MVCPatternDemo.php

```php
<?php

declare(strict_types=1);

require_once __DIR__ . '/Student.php';
require_once __DIR__ . '/StudentView.php';
require_once __DIR__ . '/StudentController.php';

class MVCPatternDemo
{
    public static function retrieveStudentFromDatabase(): Student
    {
        $student = new Student();
        $student->setName("Robert");
        $student->setRollNo("10");
        return $student;
    }
}

//fetch student record based on his roll no from the database
$model = MVCPatternDemo::retrieveStudentFromDatabase();

//Create a view : to write student details on console
$view = new StudentView();

//Create controller
$controller = new StudentController($model, $view);

$controller->updateView();

//Update model data
$controller->setStudentName("John");

$controller->updateView();
```

## Paso 5

Verifique la salida.

```note
Student:
Name: Robert
Roll No: 10
Student:
Name: John
Roll No: 10
```

---

:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
