@extends('base')

@section('title', $company->name)

@section('styles')
    <link rel="stylesheet" href="{{ URL::asset('css/company.css') }}">
@endsection

@section('content') 

    <div class="col-lg-8 mx-auto p-4 py-md-5">

      @foreach ($fields as $field)
      @if ($field->readable)
      <p class="field-name">{{$field->readable}}</p>
      <div class="d-flex justify-content-between bd-highlight mb-3">
          <div class="field-text">
            <p>
              {{ $company[$field->field] }}
            </p>
          </div>
          @auth
          <div>
              <button class="btn btn-link pt-0 comment-btn" type="button" data-bs-toggle="modal" data-bs-target="#addCommentModal" onclick="openWindow('{{$field->field}}')">
                  <i class="bi bi-chat-right-text" style="font-size: 0.95rem"></i> Прокомментировать
              </button>
          </div>
          @endauth
      </div>
      @auth
      <p class="ms-3 notification" id="newComments_{{$field->field}}" onclick="destroyNotification('{{$field->field}}')"></p>
      <div class="ms-3 text-secondary" id="comments_{{$field->field}}"></div>
      @endauth
      @endif
      @endforeach
    
      @auth
      {{-- комментарии о компании не поле --}}
      <div class="d-flex d-flex align-items-end flex-column mt-3">
        <div class="p-2">
            <button class="btn btn-link pt-0 comment-btn" type="button" data-bs-toggle="modal" data-bs-target="#addCommentModal" onclick="openWindow('{{$field->field}}')">
                <i class="bi bi-chat-right-text" style="font-size: 0.95rem"></i> Прокомментировать компанию
            </button>
        </div>
      </div>
      <p class="ms-3 notification" id="newComments_company" onclick="destroyNotification('{{$field->field}}')"></p>
      <div class="ms-3 text-secondary" id="comments_company"></div>

      {{-- модальное окно --}}
      <div class="modal fade" id="addCommentModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="ModalLabel">Добавить комментарий</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                    <label for="floatingTextarea">Comments</label>
                </div>
                <input type="hidden" id="field" value="">
                <input type="hidden" id="company-id" value="{{$company->id}}">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
              <button type="button" class="btn btn-warning" onclick="sendComment();">Отправить</button>
            </div>
          </div>
        </div>
      </div>
      @endauth
@endsection

@section('scripts')
@auth
<script>
    const fields = []
    const comments_number = new Map() // общее количество сообщений в поле
    const unread_number = new Map()  // кол-во новых во время нахождения пользователя на странице
</script>
@foreach ($fields as $field)
<script>
        fields.push("{{ $field->field }}")
        comments_number.set("{{$field->field}}", 0)
        unread_number.set("{{$field->field}}", 0)
</script>
@endforeach
<script src="{{ URL::asset('js/update_comment.js') }}"></script>
<script src="{{ URL::asset('js/add_comment_window.js') }}"></script>
@endauth
@endsection
    