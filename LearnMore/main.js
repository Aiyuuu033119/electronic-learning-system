$(document).ready(function() {

    $('.modal').modal({
        dismissible: false,
        opacity: .5,
        inDuration: 300,
        outDuration: 200,
        startingTop: '4%',
        endingTop: '10%',
    });
    $('.dropdown-button').dropdown({
        inDuration: 300,
        outDuration: 225,
        constrainWidth: false, // Does not change width of dropdown to that of the activator
        hover: false, // Activate on hover
        gutter: 0, // Spacing from edge
        belowOrigin: true, // Displays dropdown below the button
        alignment: 'left', // Displays dropdown with edge aligned to the left of button
        stopPropagation: false // Stops event propagation
    });
    $('#friends.dropdown-content').css({
        'margin-top': 6,
        'width': '400px',
        'margin-left': '50px',
    });
    $('.carousel').carousel({
        shift: 60,
        dist: -200,
        padding: 10,
    });

    $('select').material_select();
    //ADD ITEM QUESTION
    var i = 1;
    $('#questBtn').click(function() {
        i++;
        if (i <= 10) {
            $('#colItem').append('<a href="#num' + i + '" id="colItem" class="collection-item colHover2 center">' + i + '</a>');
            $('#question').append('<div class="row panel" id="num' + i + '"><br>' +
                '<div class="col l12">' +
                '<div class="section row">' +
                '<div class="col l12" id="displayType1">' +
                '<div class="input-field border-radius">' +
                '<input placeholder="Question ' + i + '" id="askQuestion" type="text" class="center inputAdjust border-radius border-color white-text" name="askQuestion[]">' +
                '</div>' +
                '<div class="input-field row">' +
                '<div class="col l1 lettera pickA' + i + '" id="' + i + '">' +
                '<p class="center letter" >A</p>' +
                '</div>' +
                '<input style="position:absolute" placeholder="Choice 1" id="choiceA' + i + '" type="text" class="col l11 inputAdjust center border-radius2 border-color white-text" name="choiceA[]">' +
                '</div>' +
                '<div class="input-field row">' +
                '<div class="col l1 letterb pickB' + i + '" id="' + i + '">' +
                '<p class="center letter" >B</p>' +
                '</div>' +
                '<input style="position:absolute" placeholder="Choice 2" id="choiceB' + i + '" type="text" class="col l11 inputAdjust center border-radius2 border-color white-text" name="choiceB[]">' +
                '</div>' +
                '<div class="input-field row">' +
                '<div class="col l1 letterc pickC' + i + '" id="' + i + '">' +
                '<p class="center letter" >C</p>' +
                '</div>' +
                '<input style="position:absolute" placeholder="Choice 3" id="choiceC' + i + '" type="text" class="col l11 inputAdjust center border-radius2 border-color white-text" name="choiceC[]">' +
                '</div>' +
                '<div class="input-field row">' +
                '<div class="col l1 letterd pickD' + i + '" id="' + i + '">' +
                '<p class="center letter" >D</p>' +
                '</div>' +
                '<input style="position:absolute" placeholder="Choice 4" id="choiceD' + i + '" type="text" class="col l11 inputAdjust center border-radius2 border-color white-text" name="choiceD[]">' +
                '</div>' +
                '<div class="divider"></div>' +
                '<div class="input-field white hide">' +
                '<input id="answer' + i + '" type="text" class="col l11 inputAdjust" name="answer[]">' +
                '</div>' +
                '<div class="col l12">' +
                '<h6 class="white-text" >Answer: <span id="showAnswer' + i + '"> Please select the letter for the answer</span></h5>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>');
            $('select').material_select();
        } else {
            alert("It must be minimum of 10 question");
        }


    });

    $('#questBtn2').click(function() {
        i++;
        if (i <= 10) {
            $('#colItem2').append('<a href="#nums' + i + '" id="colItem" class="collection-item colHover2 center">' + i + '</a>');
            $('#question2').append('<div class="row panel" id="nums' + i + '"><br>' +
                '<div class="col l10">' +
                '<p class="white-text">Question ' + i + '</p>' +
                '</div>' +
                '<div class="col l12">' +
                '<div class="section row">' +
                '<div class="col l12" id="displayType1">' +
                '<div class="input-field border-radius">' +
                '<input placeholder="Question ' + i + '" id="' + i + '" type="text" class="center inputAdjust border-radius border-color white-text tfQuestion' + i + '" name="tfQuestion[]">' +
                '</div><br>' +
                '<div class="col l12">' +
                '<h6 class="white-text" >Take Note: <span id="showAnswer' + i + '"> Please select the for the right answer</span></h5><br>' +
                '</div>' +
                '<div class="col l12">' +
                '<div class="col l3 push-l3 true pickTrue' + i + '" id="' + i + '">' +
                '<p class="center letter" >True</p>' +
                '</div>' +
                '<div class="col l3 push-l3 false pickFalse' + i + '" id="' + i + '">' +
                '<p class="center letter" >False</p>' +
                '</div>' +
                '</div>' +
                '<div class="input-field white hide">' +
                '<input id="tfanswer' + i + '" type="text" class="col l11 inputAdjust" name="tfAnswer[]">' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>');

        } else {
            alert("It must be minimum of 10 question");
        }


    });






    $(document).on('change', '.selectOption', function() {
        var num = $(this).attr('id');
        var select = document.getElementById(num);

        var display = select.options[select.selectedIndex].text;

        if (display == "Multiple Choices") {
            alert(display);
            $('#displayType' + num).empty();
            $('#displayType' + num).append('<div class="input-field white">' +
                '<input placeholder="Question" id="myquest" type="text" class="center inputAdjust" name="prc">' +
                '</div>' +
                '<div class="input-field white row">' +
                '<div class="col l1 " id="A">' +
                '<p class="center letter" >A</p>' +
                '</div>' +
                '<input placeholder="Choice 1" id="modalPrc" type="text" class="col l11 inputAdjust" name="prc">' +
                '</div>' +
                '<div class="input-field white row">' +
                '<div class="col l1" id="B">' +
                '<p class="center letter" >B</p>' +
                '</div>' +
                '<input placeholder="Choice 1" id="modalPrc" type="text" class="col l11 inputAdjust" name="prc">' +
                '</div>' +
                '<div class="input-field white row">' +
                '<div class="col l1 " id="C">' +
                '<p class="center letter" >C</p>' +
                '</div>' +
                '<input placeholder="Choice 1" id="modalPrc" type="text" class="col l11 inputAdjust" name="prc">' +
                '</div>' +
                '<div class="input-field white row">' +
                '<div class="col l1 " id="D">' +
                '<p class="center letter" >D</p>' +
                '</div>' +
                '<input placeholder="Choice 1" id="modalPrc" type="text" class="col l11 inputAdjust" name="prc">' +
                '</div>');
        } else if (display == "True/False") {
            alert(display);
            $('#displayType' + num).empty();
            $('#displayType' + num).append('<div class="input-field white">' +
                '<input placeholder="Question" id="myquest" type="text" class="center inputAdjust" name="prc">' +
                '</div>' +
                '<div class="input-field white">' +
                '<select>' +
                '<option value="" disabled selected>Choose the right answer</option>' +
                '<option value="1">True</option>' +
                '<option value="2">False</option>' +
                '</select>' +
                '</div>');
            $('select').material_select();
        } else if (display == "Underline") {
            alert(display);
            $('#displayType' + num).empty();
            $('#displayType' + num).append('<div class="input-field white">' +
                '<input placeholder="Question" id="myquest" type="text" class="center inputAdjust" name="prc">' +
                '</div>' +
                '<div class="input-field white row">' +
                '<div class="col l1 " id="A">' +
                '<p class="center letter" >A</p>' +
                '</div>' +
                '<input placeholder="Choice 1" id="modalPrc" type="text" class="col l11 inputAdjust" name="prc">' +
                '</div>' +
                '<div class="input-field white row">' +
                '<div class="col l1" id="B">' +
                '<p class="center letter" >B</p>' +
                '</div>' +
                '<input placeholder="Choice 1" id="modalPrc" type="text" class="col l11 inputAdjust" name="prc">' +
                '</div>' +
                '<div class="input-field white row">' +
                '<div class="col l1 " id="C">' +
                '<p class="center letter" >C</p>' +
                '</div>' +
                '<input placeholder="Choice 1" id="modalPrc" type="text" class="col l11 inputAdjust" name="prc">' +
                '</div>' +
                '<div class="input-field white row">' +
                '<div class="col l1 " id="D">' +
                '<p class="center letter" >D</p>' +
                '</div>' +
                '<input placeholder="Choice 1" id="modalPrc" type="text" class="col l11 inputAdjust" name="prc">' +
                '</div>');

        }
    });


    var x = 1;
    $('#topicBtn').click(function() {
        x++;

        if (x <= 15) {
            $('#topicItem').append('<a href="#num' + x + '" id="removeItem' + x + '" class="collection-item colHover2 center">' + x + '</a>');
            $('#topic').append('<div class="row panel" id="num' + x + '"><br>' +
                '<div class="col l12">' +
                '<div class="row">' +
                '<div class="col l12" id="displayType' + x + '">' +
                '<div class="input-field border-radius">' +
                '<input placeholder="Sub-Topic" type="text" class="center inputAdjust border-radius border-color white-text" name="topic[]">' +
                '</div>' +
                '<div class="input-field white hide">' +
                '<textarea id="txt' + x + '" name="content[]" placeholder="Discussion... Minimum 2500 letters" class="materialize-textarea inputAdjust"></textarea>' +
                '</div>' +
                '<div class="input-field border-radius">' +
                '<textarea placeholder="Content" id="' + x + '" class="materialize-textarea inputAdjust msg border-radius center border-color white-text content' + x + '"></textarea>' +
                '</div>' +
                '<br>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>');
        } else {
            alert("It must be minimum of 15 question");
        }


    });

    $('#topicBtn2').click(function() {
        x++;
        if (x <= 15) {
            $('#topicItem').append('<a href="#num' + x + '" id="removeItem' + x + '" class="collection-item colHover2 center">' + x + '</a>');
            $('#topic').append('<div class="row panel" id="num' + x + '"><br>' +
                '<div class="col l12">' +
                '<p class="white-text center">Sub-Topic</p>' +
                '</div>' +
                '<div class="col l12">' +
                '<div class="row">' +
                '<div class="col l12" id="displayType1">' +
                '<div class="input-field white">' +
                '<input placeholder="Sub-Topic" id="myquest" type="text" class="center inputAdjust" name="topic[]">' +
                '</div>' +
                '<div class="input-field white ">' +
                '<textarea name="content[]" id="" placeholder="Discussion... Minimum 2500 letters" class="materialize-textarea inputAdjust"></textarea>' +
                '</div><br>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>');
        } else {
            alert("It must be minimum of 15 question");
        }
    });

});



function selectType() {
    var select = document.getElementById("1");
    var selectNum = $('select.selectOption').attr('id');
    var display = select.options[select.selectedIndex].text;

    document.getElementById("myquest").value = display;


}