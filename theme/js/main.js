function addNode(text, url)
{
    $(".dd > ol").append("<li class='dd-item dd3-item' data-text='"+text+"' data-url='"+url+"'><div class='dd-handle dd3-handle'></div><div class='dd3-content'>"+text+"</div><div class='dd-edit dd3-edit'></div></li>");
}

function build(item){
    var html = "<li class='dd-item dd3-item' data-text='"+item.text+"' data-url='"+item.url+"'><div class='dd-handle dd3-handle'></div><div class='dd3-content'>"+item.text+"</div><div class='dd-edit dd3-edit'></div></div>";

    if( item.children ) {
        html += "<ol class='dd-list'>";
        $.each(item.children, function(index, sub){
            html += build(sub);
        });
        html += "</ol>";
    }

    html += "</li>";
    return html;
}

function updateOut()
{
    obj = $('.dd').nestable('serialize');
    //$('#output').html(window.JSON.stringify(obj));
    $('#structure').val(window.JSON.stringify(obj));
}

function store(name, structure, id)
{
    if (id == undefined) {
        id = '';
    }

    $.ajax({
        url: baseUrl+"?page=store",
        data: {name: name, structure: structure, id: id},
        method: 'post',
        dataType: 'JSON',
        success: function (msg) {
            if(msg.status == 'ok') {
                alert(msg.message);
                window.location.href = msg.redirect;
            }
        }
    });
}



$(document).ready(function(){
    $('.dd').nestable();

    $('.dd').on('change', function() {
        updateOut();
    });

    $('#addNode').click(function(e){
        e.preventDefault();

        anchor  = $('#anchor').val();
        url     = $('#url').val();

        if(anchor.trim() == '') {
            alert('Anchor field can not be empty');
            $('#anchor').val('');
            return;
        }

        if (url.trim() == '') {
            url = '#';
        }

        addNode(anchor, url);

        $('#anchor').val('');
        $('#url').val('');

        updateOut();
    });

    $('#saveMenu').click(function(e){
        e.preventDefault();

        name        = $('#menuName').val();
        structure   = $('#structure').val();
        id          = ($('#id').length != 0) ? $('#id').val() : undefined;

        if(name.trim() == '') {
            alert('Menu Name field can not be empty');
            $('#menuName').val('');
            $('#menuName').focus();
            return;
        }


        store(name, structure, id);
    });

    $(document).on('click', '.dd-edit', function() {
        $this = $(this);

        if ($this.next('.edit-window').length != 0) {
            $this.next('.edit-window').remove();
            $this.removeClass('active');
            return;
        }

        $this.addClass('active');

        text = $this.parent('li').attr('data-text');
        url  = $this.parent('li').attr('data-url');


        $this.after('<div class="edit-window"><div><input type="text" role="anchor" placeholder="Anchor" value="'+text+'"></div><div><input type="text" role="url" placeholder="URL" value="'+url+'"></div><button class="delete">Delete</button><button class="cancel">Cancel</button><button class="save">Save</button></div>');
    });

    $(document).on('click', '.edit-window button.save', function(){

        $this   = $(this);
        text    = $this.siblings('div').children('input[role="anchor"]').val();
        url     = $this.siblings('div').children('input[role="url"]').val();

        $this.parents('li:first').attr("data-text", text);
        $this.parents('li:first').attr("data-url", url);

        $this.parent('.edit-window').siblings('.dd-edit').removeClass('active');
        $this.parent('.edit-window').siblings('.dd3-content').html(text);
        $this.parent('.edit-window').remove();

        updateOut();
    });

    $(document).on('click', '.edit-window button.cancel', function(){
        $this   = $(this);
        $this.parent('.edit-window').siblings('.dd-edit').removeClass('active');
        $this.parent('.edit-window').remove();
    });

    $(document).on('click', '.edit-window button.delete', function(){
        $(this).parents('.dd-item:first').remove();

        updateOut();
    });

});