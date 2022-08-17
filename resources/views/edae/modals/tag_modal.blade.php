<div class="modal fade" id="add_tag_modal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Добавить тег</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="add_tag_form" action="{{ $url_store_tag }}" method="post">
                <div class="modal-body">
                    <label for="">Наименование тега</label>
                    @csrf
                    <input class="form-control" type="text" name="name" value="">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" onclick="sendFormFunction(add_tag_form, (data) => {
                        if (data.status) {
                            $(tags).append('<option selected value=' + data.tag.id + '>' + data.tag.name + '</option>')
                            $(add_tag_form).find('[name=name]').val(null)
                            $(add_tag_form).find('[data-dismiss=modal]').click()
                        } else {
                            toastr.error('Ошибка добавления, попробуйте еще раз')
                        }
                    })" class="btn btn-primary">@lang('general.save')</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('general.cancel')</button>
                </div>
            </form>
        </div>
    </div>
</div>
