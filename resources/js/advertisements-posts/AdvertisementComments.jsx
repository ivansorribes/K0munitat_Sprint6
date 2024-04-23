import React, { useState, useEffect } from "react";
import { createRoot } from "react-dom/client";
import { CommentLikeButton } from "../components/CommentLikeButton";
import { ReplyBox } from "../components/ReplyBox";
import { ReplyLikeButton } from "../components/ReplyLikeButton";
import { fetchComments, postComment, saveEditedComment, deleteComment, toggleLike, toggleLikeReply, deleteReply, sendReply, saveEditedReply } from "../helpers/api";

export default function AdvertisementComments() {
    const [comments, setComments] = useState([]);
    const [newComment, setNewComment] = useState('');
    const [editingCommentId, setEditingCommentId] = useState(null);
    const [editingCommentText, setEditingCommentText] = useState("");
    const [postId, setPostId] = useState(null);
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [commentToDelete, setCommentToDelete] = useState(null);
    // const userId = document.getElementById("id_user").value;
    const username = document.getElementById("username").value;
    const [activeReplyBox, setActiveReplyBox] = useState(null);
    const [replyToDelete, setReplyToDelete] = useState(null);
    const [isModalReplyOpen, setIsModalReplyOpen] = useState(false);
    const [editingReplyId, setEditingReplyId] = useState(null);
    const [editingReplyText, setEditingReplyText] = useState("");
    const [communityId, setCommunityId] = useState(null);
    const [userId, setUserId] = useState(document.getElementById("id_user").value);  // Es mejor manejar esto de otra manera si es posible
    const [trigger, setTrigger] = useState(0);

    useEffect(() => {
        const pathParts = window.location.pathname.split('/');
        const communityIdLocal = pathParts[pathParts.length - 2];
        const postIdLocal = pathParts[pathParts.length - 1];

        setCommunityId(communityIdLocal);
        setPostId(postIdLocal);

        if (communityIdLocal && postIdLocal) {
            const loadComments = async () => {
                const fetchedComments = await fetchComments(communityIdLocal, postIdLocal);
                setComments(fetchedComments);
            };

            loadComments();
        }
    }, [trigger]);

    const handlePostComment = async () => {
        await postComment(postId, userId, newComment, setComments, setNewComment);
        setTrigger(oldTrigger => ++oldTrigger);
    };

    const handleEditComment = (comment) => {
        setEditingCommentId(comment.id);
        setEditingCommentText(comment.comment);
    };

    const handleCancelEdit = () => {
        setEditingCommentId(null);
        setEditingCommentText("");
    };

    const handleSaveEditComment = () => {
        saveEditedComment(editingCommentId, editingCommentText, setComments, handleCancelEdit);
    };

    const handleDeleteClick = (commentId) => {
        setCommentToDelete(commentId);
        setIsModalOpen(true);
    };

    const handleDeleteComment = () => {
        deleteComment(commentToDelete, setComments, setIsModalOpen, setCommentToDelete);
    };

    const onToggleLikeComment = (commentId) => {
        toggleLike(commentId, setComments);
    };

    const onToggleLikeReply = (replyId, commentId) => {
        toggleLikeReply(replyId, commentId, setComments);
    };

    const handleEditReply = (reply) => {
        setEditingReplyId(reply.id);
        setEditingReplyText(reply.reply);
    };

    const handleDeleteReply = () => {
        deleteReply(replyToDelete, setComments, setReplyToDelete, setIsModalReplyOpen);
    };

    const handleReply = (commentId, replyText) => {
        sendReply(commentId, replyText, setActiveReplyBox, fetchComments);
        setTrigger(oldTrigger => oldTrigger + 1);
    };

    const handleSaveReplyEdit = () => {
        saveEditedReply(editingReplyId, editingReplyText, setComments);
        setEditingReplyId(null);
        setTrigger(oldTrigger => oldTrigger + 1);
    };

    return (
        <>
            <section className="bg-white py-8 lg:py-16 antialiased">
                <div className="max-w-2xl mx-auto px-4">
                    <h2 className="text-lg lg:text-2xl font-extrabold text-neutral mb-6">Comments</h2>
                    {comments.map((comment) => (
                        <article key={comment.id} className="p-6 mb-4 text-base bg-white rounded-lg border border-neutral">
                            {editingCommentId === comment.id ? (
                                <div>
                                    <textarea
                                        className="w-full p-2 text-sm text-neutral border-2 border-neutral rounded-lg focus:border-neutral focus:ring-0"
                                        value={editingCommentText}
                                        onChange={(e) => setEditingCommentText(e.target.value)}
                                    />
                                    <button onClick={handleSaveEditComment} className="mr-2 py-2 px-4 text-xs font-bold text-neutral bg-secondary rounded-lg hover:bg-accent">Save</button>
                                    <button onClick={handleCancelEdit} className="py-2 px-4 text-xs font-bold text-neutral bg-gray-300 rounded-lg hover:bg-gray-400">Cancel</button>
                                </div>
                            ) : (
                                <div>
                                    <footer className="mb-2">
                                        <div className="flex items-center justify-between w-full">
                                            <div className="flex items-center space-x-3">
                                                <img
                                                    src={comment.user.profile_image}
                                                    alt="Profile Image"
                                                    className="h-10 w-10 rounded-full"
                                                />
                                                <p className="text-sm text-neutral font-extrabold">
                                                    {comment.user.username}
                                                </p>
                                                {comment.user.id == userId && (
                                                    <div>
                                                        <button onClick={() => handleEditComment(comment)} className="py-1 px-3 text-xs font-bold text-neutral bg-[#62adde] rounded-lg hover:bg-blue-800">Edit</button>
                                                        <button onClick={() => handleDeleteClick(comment.id)} className="ml-2 py-1 px-3 text-xs font-bold text-neutral bg-[#E51C1C] rounded-lg hover:bg-red-600">Delete</button>
                                                    </div>
                                                )}
                                            </div>

                                            <CommentLikeButton
                                                commentId={comment.id}
                                                liked={comment.liked}
                                                likesCount={comment.likes_count}
                                                onToggleLike={onToggleLikeComment}
                                            />
                                        </div>

                                    </footer>
                                    <p className="text-neutral">
                                        {comment.comment}
                                    </p>
                                    {comment.replies && comment.replies.length > 0 && (
                                        <div className="mt-4">
                                            <h4 className="text-sm text-neutral font-bold mb-2">Replies</h4>
                                            {comment.replies.map((reply) => (
                                                <div key={reply.id} className="ml-4 mb-2 p-2 bg-gray-100 rounded-lg">
                                                    <div className="flex items-center space-x-3 mb-1">
                                                        <img src={reply.user.profile_image} alt="Profile Image" className="h-6 w-6 rounded-full" />
                                                        <p className="text-xs text-neutral font-extrabold">{reply.user.username}</p>
                                                        {reply.user.id == userId && (
                                                            <div>
                                                                {editingReplyId === reply.id ? (
                                                                    <>
                                                                        <textarea
                                                                            className="w-full p-2 text-xs text-neutral border border-neutral rounded-lg"
                                                                            value={editingReplyText}
                                                                            onChange={(e) => setEditingReplyText(e.target.value)}
                                                                        />
                                                                        <button
                                                                            onClick={handleSaveReplyEdit}
                                                                            className="py-1 px-3 text-xs font-bold text-neutral bg-blue-500 rounded-lg hover:bg-blue-800">Save</button>
                                                                        <button
                                                                            onClick={() => setEditingReplyId(null)}
                                                                            className="py-1 px-3 text-xs font-bold text-neutral bg-gray-300 rounded-lg hover:bg-gray-400">Cancel</button>
                                                                    </>
                                                                ) : (
                                                                    <>
                                                                        <button
                                                                            onClick={() => handleEditReply(reply)}
                                                                            className="py-1 px-3 text-xs font-bold text-neutral bg-[#62adde] rounded-lg hover:bg-blue-800">Edit</button>
                                                                        <button
                                                                            onClick={() => { setReplyToDelete(reply.id); setIsModalReplyOpen(true); }}
                                                                            className="ml-2 py-1 px-3 text-xs font-bold text-neutral bg-[#E51C1C] rounded-lg hover:bg-red-600">Delete
                                                                        </button>
                                                                    </>
                                                                )}
                                                            </div>
                                                        )}
                                                    </div>
                                                    {editingReplyId !== reply.id && <p className="text-xs text-neutral">{reply.reply}</p>}
                                                    <ReplyLikeButton
                                                        replyId={reply.id}
                                                        liked={reply.liked || false}
                                                        likesCount={reply.likes_count}
                                                        onToggleLikeReply={() => onToggleLikeReply(reply.id, comment.id)}
                                                    />
                                                </div>
                                            ))}
                                            {/* Modal: debe estar fuera del bucle map */}
                                            {isModalReplyOpen && (
                                                <div className="fixed inset-0 flex justify-center items-center">
                                                    <div className="bg-white p-4 rounded-lg">
                                                        <p>Are you sure you want to delete this reply?</p>
                                                        <button onClick={handleDeleteReply} className="mr-2 py-2 px-4 text-xs font-bold text-white bg-red-500 rounded-lg hover:bg-red-600">Delete</button>
                                                        <button onClick={() => setIsModalReplyOpen(false)} className="py-2 px-4 text-xs font-bold text-black bg-gray-300 rounded-lg hover:bg-gray-400">Cancel</button>
                                                    </div>
                                                </div>
                                            )}
                                        </div>
                                    )}

                                    <div className="flex justify-between items-center mt-2">
                                        <button
                                            className="py-1 px-3 text-xs font-bold text-neutral bg-blue-500 rounded-lg hover:bg-blue-800"
                                            onClick={() => setActiveReplyBox(activeReplyBox === comment.id ? null : comment.id)}
                                        >Reply
                                        </button>
                                    </div>
                                    {activeReplyBox === comment.id && (
                                        <ReplyBox
                                            key={comment.id}
                                            commentId={comment.id}
                                            onSendReply={(replyText) => handleReply(comment.id, replyText)}
                                        />
                                    )}
                                </div>
                            )}
                        </article>
                    ))}

                    <div className="mb-6">
                        <textarea
                            id="comment"
                            rows="4"
                            className="w-full p-2 text-sm text-neutral border-2 border-neutral rounded-lg focus:border-neutral focus:ring-0"
                            placeholder="Write a comment..."
                            value={newComment}
                            onChange={(e) => setNewComment(e.target.value)}
                            required
                        />
                        <button
                            type="button"
                            className="mt-2 py-2 px-4 text-xs font-bold text-neutral bg-[#808080] rounded-lg hover:bg-accent"
                            onClick={handlePostComment}
                        >
                            Post comment
                        </button>
                    </div>
                </div>
            </section>
            {isModalOpen && (
                <div className="fixed inset-0 flex justify-center items-center">
                    <div className="bg-white p-4 rounded-lg">
                        <p>Are you sure you want to delete this comment?</p>
                        <button onClick={handleDeleteComment} className="mr-2 py-2 px-4 text-xs font-bold text-white bg-red-500 rounded-lg hover:bg-red-600">Delete</button>
                        <button onClick={() => setIsModalOpen(false)} className="py-2 px-4 text-xs font-bold text-black bg-gray-300 rounded-lg hover:bg-gray-400">Cancel</button>
                    </div>
                </div>
            )}
        </>
    );
}

if (document.getElementById("advertisementComments")) {
    createRoot(document.getElementById("advertisementComments")).render(<AdvertisementComments />);
}
