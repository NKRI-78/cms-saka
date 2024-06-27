<script>
    $('#dataProduct').DataTable();

    CreateProduct = async () => {
        let data = new FormData();
        var name = $("#name").val();
        var price = $("#price").val();
        var weight = $("#weight").val();
        var stock = $("#stock").val();
        var description = $("#description").val();
        var category = $("#category").val();
        var condition = $("#condition").val();
        var minOrder = $("#minOrder").val();

        var totalfiles = document.getElementById('files').files.length;

        for (var i = 0; i < totalfiles; i++) {
            data.append("files[]", document.getElementById('files').files[i]);
        }
        
        data.append('name', name);
        data.append('price', price);
        data.append('weight', weight);
        data.append('stock', stock);
        data.append('description', description);
        data.append('category', category);
        data.append('condition', condition);
        data.append('minOrder', minOrder);

        $("#create-product").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/user/product/post-product`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('create product success');
                location.reload();
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#create-product").text('Submit');
            }
        });
    }

    UpdateProduct = async () => {
        let data = new FormData();
        var productId = $("#productId").val();
        var name = $("#name").val();
        var price = $("#price").val();
        var weight = $("#weight").val();
        var stock = $("#stock").val();
        var description = $("#description").val();
        var category = $("#category").val();
        var condition = $("#condition").val();
        var minOrder = $("#minOrder").val();

        var totalfiles = document.getElementById('files').files.length;
        for (var i = 0; i < totalfiles; i++) {
            data.append("files[]", document.getElementById('files').files[i]);
        }

        data.append('productId', productId);
        data.append('name', name);
        data.append('price', price);
        data.append('weight', weight);
        data.append('stock', stock);
        data.append('description', description);
        data.append('category', category);
        data.append('condition', condition);
        data.append('minOrder', minOrder);

        $("#create-product").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/user/product/update-product`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('update product success');
                location.reload();
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#create-product").text('Update');
            }
        });
    }

    ImportProduct = async () => {
        let data = new FormData();
        var category = $("#category").val();
        var csv = $('#file');
        var csvFile = csv[0].files[0];

        if (category == "null") {
            toastr.warning('category required');
            return
        }

        data.append('category', category);
        data.append('file', csvFile);

        $("#import-product").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/user/product/import-product`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('import product success');
                location.reload();
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#import-product").text('Submit');
            }
        });
    }
</script>