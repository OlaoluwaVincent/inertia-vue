import videojs from 'video.js';

async function useVideoMetadata(videoUrl) {
    if (!videoUrl) {
        return;
    }

    return new Promise((resolve, reject) => {
        const videoElement = document.createElement('video');
        const player = videojs(videoElement);

        player.src(videoUrl);

        player.on('loadedmetadata', () => {
            resolve(player.duration());
            player.dispose(); // Clean up the player instance
        });

        player.on('error', () => {
            reject('Error loading video metadata');
            player.dispose(); // Clean up the player instance
        });

        player.load();
    });
}

const fetchVideoLengths = async (lessons) => {
    const promises = lessons.map(async (lesson) => {
        try {
            const metadata = await useVideoMetadata(lesson.video_url);
            return { id: lesson.id, length: metadata / 60 };
        } catch (error) {
            console.error(error);
            return { id: lesson.id, length: undefined };
        }
    });

    const results = await Promise.all(promises);
    return results.reduce((acc, {id, length}) => {
        acc[id] = length;
        return acc;
    }, {});
};

export {fetchVideoLengths}
export default useVideoMetadata;
