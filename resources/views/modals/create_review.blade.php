@auth
    <div class="modal fade" id="createReviewModal" tabindex="-1" aria-labelledby="createReviewModalLabel">
        <div class="modal-dialog">
            <div class="modal-content" style="width: 150%; margin-left: -25%;">
                <div class="modal-header">
                    <h5 class="modal-title" id="createReviewModalLabel">レビューの作成</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                </div>
                <form action="{{ route('reviews.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="rate-form">
                            <input type="radio" id="star5" name="rate" value="5">
                            <label for="star5">★</label>
                            <input type="radio" id="star4" name="rate" value="4">
                            <label for="star4">★</label>
                            <input type="radio" id="star3" name="rate" value="3">
                            <label for="star3">★</label>
                            <input type="radio" id="star2" name="rate" value="2">
                            <label for="star2">★</label>
                            <input type="radio" id="star1" name="rate" value="1">
                            <label for="star1">★</label>
                        </div>
                        <div>
                            <textarea name="content" id="" cols="90" rows="10"></textarea>
                        </div>
                        <input type="hidden" name="store_id" value="{{ $store->id }}">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">投稿する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endauth
