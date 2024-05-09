class SocialMediaShare {
    constructor(url) {
        this.urlToShare = url;
    }

    shareOnTwitter() {
        const twitterShareUrl = `https://twitter.com/intent/tweet?url=${encodeURIComponent(
            this.urlToShare
        )}`;
        window.open(twitterShareUrl, "_blank", "width=600,height=400");
    }

    shareOnFacebook() {
        const facebookShareUrl = `https://www.facebook.com/sharer/sharer.php?href=${encodeURIComponent(
            this.urlToShare
        )}&quote=Check%20out%20this%20link`; // Include href parameter directly
        window.open(facebookShareUrl, "_blank", "width=600,height=400");
    }
}
export default SocialMediaShare;
