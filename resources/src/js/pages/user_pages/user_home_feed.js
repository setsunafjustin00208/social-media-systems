document.addEventListener('alpine:init', () => {
    Alpine.data('userHomeFeed', () => ({
        newPostContent: '',
        posts: [],

        init() {
            // Initialize posts
            this.posts = [
                {
                    id: 1,
                    author: 'Emma Wilson',
                    timestamp: '3 hours ago',
                    content: 'Just finished my morning hike! The view was absolutely breathtaking today. 🏞️ #nature #outdoors',
                    liked: false,
                    reaction: null, // Store the current reaction
                },
                {
                    id: 2,
                    author: 'Michael Chen',
                    timestamp: 'Yesterday at 7:30 PM',
                    content: 'Just got my hands on the latest tech gadget! Can’t wait to try it out. 🚀 #techie #newgadget',
                    liked: false,
                    reaction: null,
                },
                {
                    id: 3,
                    author: 'Sophia Martinez',
                    timestamp: '2 days ago',
                    content: 'Had an amazing dinner at this new Italian restaurant downtown. Highly recommend it! 🍝 #foodie #yum',
                    liked: false,
                    reaction: null,
                },
                {
                    id: 4,
                    author: 'Liam Johnson',
                    timestamp: '4 days ago',
                    content: 'Finally finished reading that book everyone’s been talking about. It was worth the hype! 📚 #bookworm',
                    liked: false,
                    reaction: null,
                },
                {
                    id: 5,
                    author: 'Olivia Brown',
                    timestamp: 'Last week',
                    content: 'Can’t believe it’s been a year since I started my fitness journey. Feeling stronger every day! 💪 #fitness #motivation',
                    liked: false,
                    reaction: null,
                },
            ];
        },

        addPost() {
            // Add a new post
            if (this.newPostContent.trim() === '') return;

            this.posts.unshift({
                id: Date.now(),
                author: 'You',
                timestamp: 'Just now',
                content: this.newPostContent,
                liked: false,
                reaction: null,
            });

            this.newPostContent = '';
        },

        toggleLike(post) {
            // Toggle the like status of a post
            post.liked = !post.liked;
            if (!post.liked) {
                post.reaction = null; // Reset reaction if unliked
            }
        },

        react(post, reaction) {
            // Set or toggle a reaction for the post
            if (post.reaction === reaction) {
                // If the same reaction is clicked, reset it
                post.reaction = null;
                post.liked = false; // Unmark as liked
            } else {
                // Otherwise, set the new reaction
                post.reaction = reaction;
                post.liked = true; // Automatically mark as liked
            }
        },

        getReactionIcon(reaction) {
            // Map reactions to their respective icons
            const icons = {
                like: 'fas fa-thumbs-up has-text-info',
                love: 'fas fa-heart has-text-danger',
                laugh: 'fas fa-laugh has-text-warning',
                wow: 'fas fa-surprise has-text-primary',
                sad: 'fas fa-sad-tear has-text-grey',
                angry: 'fas fa-angry has-text-danger',
            };
            return icons[reaction] || 'far fa-thumbs-up'; // Default icon
        },

        getReactionText(reaction) {
            // Map reactions to their respective text
            const texts = {
                like: 'Like',
                love: 'Love',
                laugh: 'Haha',
                wow: 'Wow',
                sad: 'Sad',
                angry: 'Angry',
            };
            return texts[reaction] || 'Like'; // Default text
        },
    }));
});