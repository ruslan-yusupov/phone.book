<?php

use App\View;

/**
 * @var View $this
 */

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/src/dist/bundle.css">
    <title>Document</title>
    <style>
        input {
            background:rgba(0,0,0,0);
            border:none;
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
<div class="container">
    <header>
        <h1>Address Book</h1>
    </header>
    <table id='table1' class="table table-bordered">
        <thead>
        <tr>
            <th>Photo</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
            <?php
            foreach ($this->contacts as $contact) { ?>
                <th><img src="<?php echo $contact->picture; ?>" alt="<?php echo $contact->name; ?>">
                    <?php echo $contact->picture; ?>
                </th>
                <th><?php echo $contact->name; ?></th>
                <th><?php echo $contact->surname; ?></th>
                <th><?php echo $contact->phone_number; ?></th>
                <th><?php echo $contact->email; ?></th>
                <td>
                    <div class="text-center">
                        <button id='add' class='btn btn-block' />Add</button>
                    </div>
                </td>
            <?php } ?>
            <tr>
                <td>
                    <input id='photoPicture' class='form-control' type="file" />
                </td>
                <td>
                    <input id='firstName' class='form-control' type="text" />
                </td>
                <td>
                    <input id='lastName' class='form-control' type="text" />
                </td>
                <td>
                    <input id='phone' class='form-control' type="text" />
                </td>
                <td>
                    <input id='email' class='form-control' type="text" />
                </td>
                <td>
                    <div class="text-center">
                        <button id='add' class='btn btn-block' />Add</button>
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
</body>

<script src="/src/dist/bundle.js"></script>

<script>
    var addressBook = (function() {
        var people = [{
            firstName: 'Omran',
            lastName: 'Abazid',
            phone: '123456789'
        }];
        //cash the dom
        var table = $('#table1');
        var tbody = table.find('tbody');
        var $firstName = table.find('#firstName');
        var $lastName = table.find('#lastName');
        var $phone = table.find('#phone');
        var $button = table.find('#add');
        var $btnSave = table.find('#save');
        var $btnEdit = table.find('#edit');
        var $btnRemove = table.find('#remove');
        var $input = table.find(".edit");

        //bind events
        $button.on('click', addPerson);
        table.on('click', '#remove', deletePerson);
        /*table.on("change",'.edit' ,editPerson);*/
        console.log($input);
        _render();

        //render
        function _render() {
            tbody.html('');
            var length = people.length;
            for (var i = 0; i < length; i++) {
                table.prepend('<tr><td><input class="edit" type="text" value="' + people[i].firstName + '" ></td><td><input class="edit" type="text" value="' + people[i].lastName + '" ></td><td><input type="text" class="edit" value="' + people[i].phone + '" ></td><td> <button id="remove" class="btn btn-block">X</button></td></tr>');
            }
        }

        //custom function
        function addPerson() {
            var person = {
                firstName: $firstName.val(),
                lastName: $lastName.val(),
                phone: $phone.val()
            };
            people.push(person);
            $firstName.val('');
            $lastName.val('');
            $phone.val('');
            _render()
        }

        function deletePerson(event) {
            var element = event.target.closest('tr');
            var i = table.find('td').index(element);
            people.splice(i, 1);
            _render();
        }
        /*
        function editPerson(event){
           var element=event.target.closest('tr');
            var i=table.find('tr').index(element);
          var index = (table.find('tr').length -i)-1;
          console.log(element.firstChild());
          var person= {
          firstName: ,
          lastName: $lastName.val(),
          phone: $phone.val()
          };
            _render();
        }
    */
        return {
            addPerson: addPerson,
            deletePerson: deletePerson
        };

    })();
</script>

</html>