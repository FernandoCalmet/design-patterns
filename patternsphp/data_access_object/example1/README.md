# Data Access Object Pattern

El patrón de objeto de acceso a datos o patrón DAO se utiliza para separar las operaciones o la API de acceso a datos de bajo nivel de los servicios comerciales de alto nivel. A continuación se muestran los participantes en el patrón de objetos de acceso a datos.

- _Data Access Object Interface_ - Esta interfaz define las operaciones estándar que se realizarán en un objeto (s) modelo.

- _Data Access Object concrete class_ - Esta clase implementa la interfaz anterior. Esta clase es responsable de obtener datos de una fuente de datos que puede ser una base de datos / xml o cualquier otro mecanismo de almacenamiento.

- _Model Object or Value Object_ - Este objeto es POJO simple que contiene métodos get / set para almacenar datos recuperados usando la clase DAO.

## Implementación

Vamos a crear un objeto Student que actúa como un modelo o un objeto de valor. StudentDao es la interfaz de objetos de acceso a datos. StudentDaoImpl es una clase concreta que implementa la interfaz de objetos de acceso a datos. DaoPatternDemo, nuestra clase de demostración, utilizará StudentDao para demostrar el uso del patrón de objeto de acceso a datos.

![UML Diagram](dao_pattern_uml_diagram.jpg)

## Paso 1

Crear objeto de valor.

> Student.php

```php
<?php

declare(strict_types=1);

class Student
{
    private $_rollNo;
    private $_name;

    public function getRollNo(): int
    {
        return $this->_rollNo;
    }

    public function setRollNo(int $RollNo): void
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

Crear interfaz de objeto de acceso a datos.

> StudentDao.php

```php
<?php

declare(strict_types=1);

require_once __DIR__ . '/ArrayList.php';
require_once __DIR__ . '/Student.php';

interface StudentDao
{
    public function getAllStudents(): ArrayList;
    public function getStudent(int $rollNo): ?Student;
    public function updateStudent(Student $student): void;
    public function deleteStudent(Student $student): void;
}
```

## Paso 3

Cree una clase concreta implementando la interfaz anterior.

> StudentDaoImpl.php

```php
<?php

declare(strict_types=1);

require_once __DIR__ . '/ArrayList.php';
require_once __DIR__ . '/Student.php';

class StudentDaoImpl implements StudentDao
{
    //list is working as a database
    private $students;

    public function __construct()
    {
        $this->students = new ArrayList();

        $student1 = new Student();
        $student1->setName("Robert");
        $student1->setRollNo(0);
        $student2 = new Student();
        $student2->setName("Jhon");
        $student2->setRollNo(1);

        $this->students->Add($student1);
        $this->students->Add($student2);
    }

    public function deleteStudent(Student $student): void
    {
        $this->students->remove($student->getRollNo());
        print sprintf("Student: Roll No %s , deleted from database" . PHP_EOL, $student->getRollNo());
    }

    //retrive list of students from the database
    public function getAllStudents(): ArrayList
    {
        return $this->students;
    }

    public function getStudent(int $RollNo): ?Student
    {
        return $this->students->GetObj($RollNo);
    }

    public function updateStudent(Student $student): void
    {
        $this->students->GetObj($student->getRollNo());
        print sprintf("Student: Roll No %s , updated from database" . PHP_EOL, $student->getRollNo());
    }
}
```

## Paso 4

Utilice StudentDao para demostrar el uso del patrón de objetos de acceso a datos.

> DaoPatternDemo.php

```php
<?php
require_once __DIR__ . '/Student.php';
require_once __DIR__ . '/StudentDao.php';
require_once __DIR__ . '/StudentDaoImpl.php';

$studentDao = new StudentDaoImpl();

//print all students
$students = $studentDao->getAllStudents();
foreach ($students->list as $student) {
    print sprintf("Student: [RollNo: %s , Name: %s]" . PHP_EOL, $student->getRollNo(), $student->getName());
}

//update student
$student = $studentDao->getStudent(0);
$student->setName("Michael");
$studentDao->updateStudent($student);

//get the student
$student = $studentDao->getStudent(0);
print sprintf("Student: [RollNo: %s , Name: %s]" . PHP_EOL, $student->getRollNo(), $student->getName());
```

## Paso 5

Verifique la salida.

```note
Student: [RollNo : 0, Name : Robert]
Student: [RollNo : 1, Name : John]
Student: Roll No 0, updated in the database
Student: [RollNo : 0, Name : Michael]
```

---

:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
