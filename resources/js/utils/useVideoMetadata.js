async function useVideoMetadata(videoUrl) {
    if (!videoUrl) {
        return;
    }

    return new Promise((resolve, reject) => {
        const video = document.createElement('video');
        video.src = videoUrl;

        video.addEventListener('loadedmetadata', () => {
            resolve(video.duration);
        });

        video.addEventListener('error', () => {
            reject('Error loading video metadata');
        });

        video.load();
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
