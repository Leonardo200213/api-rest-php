function modifica(id) {
    var result = (id).split('i');
    var identificativo = result[1];
    var impiegato =
        {
            "id":  identificativo,
            "name": "Luca",
            "surname": "qwerty",
            "sidi_code": "gd039k",
            "tax_code": "gki97n"
        };
    var jsonStr = JSON.stringify(impiegato);
    $('#printhere').html(jsonStr);
    $.ajax({
        url: 'http://localhost:8080/student.php' + id,
        type: 'put',
        data: JSON.stringify(impiegato),
        contentType: 'application/json',
        success: function (data, textstatus, jQxhr) {
            $("#printhere").html(textstatus);
        };
    });
}






$(document).ready(function() {
    update();
    function update() {
        var cont = 0;
        $.ajax(
           {
               url: 'http://localhost:8080/student.php',
               method: 'GET',
               contenttype: 'json',
               success: function (data, textStatus, jQxhr) {
                    $.each(data.students, function (i, post) {
                        add(post.id, post.name, post.surname, post.sidi_code, post.tax_code)
                        cont++;
                    });
               };
           });
        return cont;
    }

    $('#submit').click(function () {
        alert("inserisci");
        var first = $('#first').val();
        var last = $('#last').val();
        var code = $('#codice').val();
        var tel = $('#telefono').val();
        var iden = $("#c:last").attr("id");
        iden = iden + 1;
        var impiegato =
        {
            "id": iden,
            "name": first,
            "surname": last,
            "sidi_code": code,
            "tax_code": tax
        };
		
        $.ajax({
            url: 'http://localhost:8080/student.php',
            type: 'post',
            data: JSON.stringify(impiegato),
            contentType: 'application/json',
            success: function (data, textstatus, jQxhr) {
            }
        });
    });

    function add(ID, firstName, lastName, email, phone) {
        var div = document.createElement('div');
        div.className = 'row';
		div.innerHTML = "'<tr>' + 
		'<td>' + firstName + '</td>' +
		'<td>' + lastName + '</td>' +
		'<td>' + email + '</td>' +
		'<td>' + phone + '</td>' + 
		'</tr>'";
        document.getElementById('c').appendChild(div);
    }
});