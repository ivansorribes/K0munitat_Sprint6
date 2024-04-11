export function CommentLikeButton({ commentId, liked, likesCount, onToggleLike }) {
    return (
        <div className="flex items-center gap-2">
            <button
                className={`p-2 rounded-full ${liked ? 'text-red-500' : 'text-gray-400'} hover:text-red-500 transition-colors`}
                onClick={() => onToggleLike(commentId)}
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" className="w-6 h-6">
                    <path fillRule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clipRule="evenodd" />
                </svg>
            </button>
            <span className="text-sm">{likesCount} Likes</span>
        </div>
    );
}
