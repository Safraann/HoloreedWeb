/**
 * @author Korentin Massif
 * @version 0.1
 * 
 * @file Session object manipulation 
 */

class Session
{
    /** @private id of the selected patien */                      #patient_id;
    /** @private id of the user */                                 #user_id;
    /** @private type of the session (parcours, room, minigame) */ #session_type;
    /** @private date of the session */                            #session_date;
    /** @private duration of the session */                        #session_time;
    /** @private id of the section */                              #session_id;

    /**
     * Create an instance of a Session
     * 
     * @constructor
     * @this {Session}
     * @param {number} patient_id 
     * @param {number} user_id 
     * @param {number} session_type 
     * @param {date} session_date 
     * @param {time} session_time 
     * @param {number} session_id 
     */
    constructor(patient_id, user_id, session_type, session_date = new Date().getDate(), session_time = 0, session_id = 0)
    {
        this.#patient_id = patient_id;
        this.#user_id = user_id;
        this.#session_type = session_type;
        this.#session_date = session_date;
        this.#session_time = session_time; 
        this.#session_id = session_id;
    }

    /**
     * patient_id getter
     * @returns {number} patient_id
     */
    getPatientId()
    {
        return this.#patient_id;
    }

    /**
     * patient_id setter
     * @param {number} patient_id 
     */
    setPatientId(patient_id)
    {
        this.#patient_id = patient_id;
    }

    /**
     * user_id getter
     * @returns {number} user_id
     */
    getUserId()
    {
        return this.#user_id;
    }

    /**
     * user_id setter
     * @param {number} user_id 
     */
    setUserId(user_id)
    {
        this.#user_id = user_id;
    }
    
    /**
     * session_type getter
     * @returns {number} session_type
     */
    getSessionType()
    {
        return this.#session_type;
    }

    /**
     * session_type setter
     * @param {number} session_type 
     */
    setSessionType(session_type)
    {
        this.#session_type = session_type
    }

    /**
     * session_date getter
     * @returns {date} session_date
     */
    getSessionDate()
    {
        return this.#session_date;
    }

    /**
     * session_date setter
     * @param {date} session_date 
     */
    setSessionDate(session_date)
    {
        this.#session_date = session_date
    }

    /**
     * session_time getter
     * @returns {time} session_time
     */
    getSessionTime()
    {
        return this.#session_time;
    }

    /**
     * session_time setter
     * @param {time} session_time 
     */
    setSessionTime(session_time)
    {
        this.#session_time = session_time;
    }

    /**
     * session_id getter
     * @returns {number} session_id
     */
    getSessionId()
    {
        return this.#session_id
    }
}

module.exports = Session