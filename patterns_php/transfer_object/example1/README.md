# Data Transfer Object Pattern

El patrón Transferir objeto se utiliza cuando queremos pasar datos con múltiples atributos en una sola toma de cliente a servidor. El objeto de transferencia también se conoce como objeto de valor. Transfer Object es una clase POJO simple que tiene métodos getter / setter y es serializable para que pueda transferirse a través de la red. No tiene ningún comportamiento. La clase de negocio del lado del servidor normalmente obtiene datos de la base de datos y llena el POJO y lo envía al cliente o lo pasa por valor. Para el cliente, el objeto de transferencia es de solo lectura. El cliente puede crear su propio objeto de transferencia y pasarlo al servidor para actualizar los valores en la base de datos de una sola vez. A continuación se muestran las entidades de este tipo de patrón de diseño.

- *Business Object* - Business Service llena el Transfer Object con datos.

- *Transfer Object* - POJO simple que tiene métodos para establecer / obtener atributos únicamente.

- *Client* - el cliente solicita o envía el objeto de transferencia al objeto comercial.

## Implementación

Vamos a crear un StudentBO como Business Object, Student como Transfer Object que representa nuestras entidades.

TransferObjectPatternDemo, nuestra clase de demostración, actúa como cliente aquí y utilizará StudentBO y Student para demostrar Transfer Object Design Pattern.

![UML Diagram](transferobject_pattern_uml_diagram.jpg)

## Paso 1

Crear objeto de transferencia.

> StudentVO.php

```php
<?php

declare(strict_types=1);

class StudentVO
{
    private $_name;
    private $_rollNo;

    public function __construct(string $name, int $rollNo)
    {
        $this->_name = $name;
        $this->_rollNo = $rollNo;
    }

    public function getName(): string
    {
        return $this->_name;
    }

    public function setRollNo(string $name): void
    {
        $this->_name = $name;
    }

    public function getRollNo(): int
    {
        return $this->_rollNo;
    }

    public function setName(int $rollNo): void
    {
        $this->_rollNo = $rollNo;
    }
}
```

## Paso 2

Crear objeto comercial.

> StudentBO.php

```php
<?php

declare(strict_types=1);

require_once __DIR__ . '/ArrayList.php';
require_once __DIR__ . '/StudentVO.php';

class StudentBO
{
    //list is working as a database
    private $students;

    public function __construct()
    {
        $this->students = new ArrayList();
        $student1 = new StudentVO("Robert", 0);
        $student2 = new StudentVO("Jhon", 1);
        $this->students->Add($student1);
        $this->students->Add($student2);
    }

    public function deleteStudent(StudentVO $student): void
    {
        $this->students->remove($student->getRollNo());
        print sprintf("Student: Roll No %s , deleted from database" . PHP_EOL, $student->getRollNo());
    }

    //retrive list of students from the database
    public function getAllStudents(): ArrayList
    {
        return $this->students;
    }

    public function getStudent(int $RollNo): ?StudentVO
    {
        return $this->students->GetObj($RollNo);
    }

    public function updateStudent(StudentVO $student): void
    {
        $this->students->GetObj($student->getRollNo());
        print sprintf("Student: Roll No %s , updated in the database" . PHP_EOL, $student->getRollNo());
    }
}
```

## Paso 3

Utilice StudentBO para demostrar el patrón de diseño de objetos de transferencia.

> TransferObjectPatternDemo.php

```php
<?php

require_once __DIR__ . '/StudentBO.php';

$studentBusinessObject = new StudentBO();

//print all students
$students = $studentBusinessObject->getAllStudents();
foreach ($students->list as $student) {
    print sprintf("Student: [RollNo: %s , Name: %s]" . PHP_EOL, $student->getRollNo(), $student->getName());
}

//update student
$student = $studentBusinessObject->getStudent(0);
$student->setName("Michael");
$studentBusinessObject->updateStudent($student);

//get the student
$student = $studentBusinessObject->getStudent(0);
print sprintf("Student: [RollNo: %s , Name: %s]" . PHP_EOL, $student->getRollNo(), $student->getName());
```

## Paso 4

Verifique la salida.

```note
Student: [RollNo : 0, Name : Robert ]
Student: [RollNo : 1, Name : John ]
Student: Roll No 0, updated in the database
Student: [RollNo : 0, Name : Michael ]
```

---
:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
