@extends('base')

@section('title', 'Главная')

@section('styles')
    <link rel="stylesheet" href="{{ URL::asset('css/index.css') }}">
@endsection

@section('content') 
    <div class="d-flex flex-wrap mx-auto companies-container">
        @foreach ($companies as $company)
        <div class="d-flex justify-content-between company-info mx-3 mt-3">
            <div>
                <p>
                    <a class="link-warning" href="{{route('company', $company->id)}}">{{$company->name}}</a>
                </p>
                <p>Адрес: {{$company->address}}</p>
                <p>Телефон: {{$company->number}}</p>
                <p>Генеральный директор: {{$company->director}}</p>
            </div>
            <div>
                @auth
                    <i class="bi bi-trash ms-2 btn-del" data-bs-toggle="modal" data-bs-target="#deleteCompanyModal" 
                    onclick="confirmWindow('{{$company->name}}', '{{$company->id}}')"></i>
                @endauth
            </div>
        </div>
        @endforeach
    </div>

    @auth
    <div class="d-flex mx-auto companies-container">
        <div class="p-2"> 
            <button class="btn btn-warning ms-2" type="button" data-bs-toggle="modal" data-bs-target="#addCompanyModal">
                <i class="bi bi-building-add"></i> Новая компания
            </button>
        </div>
    </div>

    @if ($errors->any())
    <div class="d-flex mx-auto ps-3 companies-container">
        <div class="p-2 alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
    </div>
    @endif
    

    {{-- модальное окно "добавить компанию" --}}
    <div class="modal fade" id="addCompanyModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('addCompany') }}">
            @csrf    
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalLabel">Добавить компанию</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating">
                        <div class="mb-3">
                        <label for="name">Название</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                        <label for="INN" class="col-form-label">ИНН</label>
                        <input type="text" name="INN" id="INN" maxlength="10" minlength="10" class="form-control" required>
                        </div>
                        <div class="mb-3">
                        <label for="gen_desc" class="col-form-label">Описание</label>
                        <textarea name="gen_desc" id="gen_desc" rows="5" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                        <label for="director" class="col-form-label">Генеральный директор</label>
                        <input type="text" name="director" id="director" maxlength="50" class="form-control" required>
                        </div>
                        <div class="mb-3">
                        <label for="address" class="col-form-label">Адрес</label>
                        <input type="text" name="address" id="address" maxlength="50" class="form-control" required>
                        </div>
                        <div class="mb-3">
                        <label for="number" class="col-form-label">Номер</label>
                        <input type="text" name="number" id="number" maxlength="25" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-warning">Создать</button>
                </div>
            </div>
            </form>
        </div>
    </div>


    {{-- модальное окно "удалить компанию"  --}}
    <div class="modal fade" id="deleteCompanyModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-3 shadow">
                <div class="modal-body p-4 text-center">
                    <h5 class="mb-0">Удалить компанию <span id="name-company-for-del"></span>?</h5>
                </div>
                <form method="POST" action="{{ route('delCompany') }}">
                 @csrf
                <div class="modal-footer flex-nowrap p-0">
                        <button type="submit" value="" id="id-company-for-del" name="company_id"
                        class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-end">
                            <span class="text-danger">Да</span>
                        </button>
                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0" data-bs-dismiss="modal">
                        Нет
                    </button>
                </div>
            </form>
            </div>
        </div>
    </div>
    
    @endauth


@endsection
    
@section('scripts')
@auth
<script src="{{ URL::asset('js/del_window_index.js') }}"></script>
@endauth
@endsection
