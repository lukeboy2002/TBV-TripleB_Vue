import { format } from "date-fns";

const relativeDate = (date) => format(new Date(date), "dd LLLL yyyy");

export { relativeDate };