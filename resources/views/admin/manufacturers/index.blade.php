@extends('layouts.app-admin')

@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col">
            @include('partials.contents.page-title.title-button', ['title' => 'Fabricante', 'route' => 'admin.fabricantes.create'])
        </div>
    </div>
    <div class="row mt-5">
        <div class="col">
            <table class="table-admin">
                <thead>
                    @include('partials.tables.head',
                    ['heads' => ['#', 'Título', 'Ações']]
                    )
                </thead>
                <tbody>
                    @foreach($manufacturers as $manufacturer)
                    <tr>
                        <td class="td-id" scope="row">{{ $manufacturer->id }}</td>
                        <td scope="row">{{ $manufacturer->manufacturer_title }}</td>
                        <td class="td-actions">
                            <a href="" class="me-1"><i class="fas fa-edit"></i></a>
                            <a href=""><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {!! $manufacturers->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection
