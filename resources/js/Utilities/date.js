import { format } from "date-fns";
// import { formatDistance, parseISO } from "date-fns";

const relativeDate = (date) => format(new Date(date), "dd LLLL yyyy");
// const relativeDate = (date) => formatDistance(parseISO(date), new Date(), { addSuffix: true });

export { relativeDate };