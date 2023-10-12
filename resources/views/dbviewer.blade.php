<x-layout>
    {{$data->links()}}
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Unique Key</th>
                <th scope="col">Product Title</th>
                <th scope="col">Product Description</th>
                <th scope="col">Style Number</th>
                <th scope="col">Sanmar Mainframe Color</th>
                <th scope="col">Size</th>
                <th scope="col">Color Name</th>
                <th scope="col">Piece Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $datum)
                <tr>
                    <td>{{$datum->UNIQUE_KEY}}</td>
                    <td>{{$datum->PRODUCT_TITLE}}</td>
                    <td>{{$datum->PRODUCT_DESCRIPTION}}</td>
                    <td>---</td>
                    <td>{{$datum->SANMAR_MAINFRAME_COLOR}}</td>
                    <td>{{$datum->SIZE}}</td>
                    <td>{{$datum->COLOR_NAME}}</td>
                    <td>{{$datum->PIECE_PRICE}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$data->links()}}
</x-layout>
