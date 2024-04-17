import React, { useState } from "react";

export function ReplyBox({ onSendReply }) {
    const [replyText, setReplyText] = useState("");
    return (
        <div className="reply-box">
            <textarea
                className="w-full p-2 text-sm border-2 border-neutral rounded-lg"
                placeholder="Write your reply..."
                value={replyText}
                onChange={(e) => setReplyText(e.target.value)}
            />
            <button
                className="py-2 px-4 text-xs font-bold text-neutral bg-secondary rounded-lg hover:bg-accent"
                onClick={() => {
                    onSendReply(replyText);
                    setReplyText("");
                }}
            >
                Send
            </button>
        </div>
    );
}
