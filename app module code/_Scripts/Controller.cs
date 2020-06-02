using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using Vuforia;
using UnityEngine.UI;
using System;
public class Controller : MonoBehaviour
{

    public GameObject[] UIScreens;

    public static Controller Instance;
    public string[] namesList;
    public List<string> runTimeNameList = new List<string>();
    public string sName;
    float startTime, waitTime;
    [HideInInspector] public bool found;
    TextTracker textTracker;

    private void Awake()
    {
        if (Instance == null)
        {
            Instance = this;
        }
        GetStudentNamesFromDatabase();

    }


    void Start()
    {
        textTracker = (TextTracker)TrackerManager.Instance.GetTracker<TextTracker>();
        timetableEmpty();
    }
    public void GetStudentNamesFromDatabase()
    {
        string url = "http://localhost/GetStudentList.php";


        WWWForm form = new WWWForm();
        WWW www = new WWW(url);
        StartCoroutine(waitForDBReport(www));
    }

    IEnumerator waitForDBReport(WWW www)
    {
        yield return www;
        namesList = www.text.Split(char.Parse(","));
        // check for errors
        if (www.error == null)
        {
            Debug.Log("WWW Ok!: " + www.text);
        }
        else
        {
            Debug.Log("WWW Error: " + www.error);
        }
    }

    string[] subName;
    int nameCounter = 0;

    public void foundName()
    {

        for (nameCounter = 0; nameCounter < namesList.Length - 1; nameCounter++)
        {
            subName = namesList[nameCounter].Split(char.Parse(" "));
            for (int j = 0; j < subName.Length; j++)
            {
                if (subName.Length == runTimeNameList.Count)
                {
                    match(subName);
                    break;
                }

            }



        }
    }
    bool OneTime;
    void match(string[] sub)
    {
        for (int i = 0; i < sub.Length; i++)
        {
            if (runTimeNameList.Contains(sub[i]) && !OneTime)
            {
                sName = namesList[nameCounter];
                OneTime = true;
                textTracker.Stop();
                GetStudentInfo();
            }
        }
        //if(temp == sub.Length)
        //{

        //}
    }

    public void onClickStartBtn()
    {
        UIScreens[0].SetActive(false);
        UIScreens[1].SetActive(true);
        startTime = Time.time;
        waitTime = startTime + 10;

        // InvokeRepeating("timeCheck", 1.0f, 1.0f);
    }
    void timeCheck()
    {

        if (waitTime < Time.time)
        {
            textTracker.Stop();

            UIScreens[2].SetActive(true);
        }
        if (found)
        {
            CancelInvoke();
        }
    }
    public void onClickReset()
    {
        textTracker.Start();
        UIScreens[3].SetActive(false);
        //startTime = Time.time;
        //waitTime = startTime + 10;

        runTimeNameList.Clear();
        sName = "";
        OneTime = false;
        found = false;
    }

    public Text SnameText, FNameText, RegNoText;
    void GetStudentInfo()
    {
        string url = "http://localhost/GetStudentInfo.php";


        WWWForm form = new WWWForm();
        form.AddField("SNamePost", sName);
        WWW www = new WWW(url, form);
        StartCoroutine(waitForStudentInfo(www));
    }


    IEnumerator waitForStudentInfo(WWW www)
    {
        yield return www;
        string[] data = www.text.Split(char.Parse(","));
        // check for errors
        if (www.error == null)
        {
            Debug.Log("WWW Ok!: " + www.text);
            SnameText.text = data[0];
            FNameText.text = data[1];
            RegNoText.text = data[4] + "-" + data[3] + "-" + data[2];
            _sesstionId = data[4];
            _programId = data[3];
            _studentId = data[2];
            UIScreens[1].SetActive(false);
            UIScreens[3].SetActive(true);

        }
        else
        {
            Debug.Log("WWW Error: " + www.error);
        }
    }

    public string _studentId, _sesstionId, _programId;

    public void OnClickAttandanceButton()
    {
        UIScreens[4].SetActive(true);
        UIScreens[3].SetActive(false);

        string url = "http://localhost/Attandance.php";


        WWWForm form = new WWWForm();
        form.AddField("studentIdPost", _studentId);
        form.AddField("programIdPost", _programId);
        form.AddField("SessionIdPost", _sesstionId);
        WWW www = new WWW(url, form);
        StartCoroutine(waitForAttandence(www));
    }
    public string[] c1;
    public int PCounter;
    public GameObject[] courseBar;
    IEnumerator waitForAttandence(WWW www)
    {
        yield return www;
        c1 = www.text.Split(char.Parse("|"));


        for (int i = 0; i < c1.Length - 1; i++)
        {
            if (i <= courseBar.Length)
            {
                courseBar[i].SetActive(true);
                string[] tempp = c1[i].Split(char.Parse(","));
                courseBar[i].transform.GetChild(1).GetComponent<Text>().text = tempp[0];
                PCounter = 0;
                for (int j = 0; j < tempp.Length - 1; j++)
                {
                    if (tempp[j] == "Present")
                    {
                        PCounter++;
                    }
                }
                int a = tempp.Length - 2;
                float percentage = (float)(PCounter / (float)a);
                courseBar[i].transform.GetChild(2).GetComponent<Text>().text = (percentage * 100).ToString("##") + " %";
                courseBar[i].transform.GetChild(0).GetComponent<UnityEngine.UI.Image>().fillAmount = percentage;


            }
        }

        if (www.error == null)
        {
            Debug.Log("WWW Ok!: " + www.text);
        }
        else
        {
            Debug.Log("WWW Error: " + www.error);
        }
    }


    public Text timeTableHeader;
    public void onClickTimeTableButton()
    {
        UIScreens[5].SetActive(true);
        UIScreens[3].SetActive(false);

        string url = "http://localhost/TimeTable.php";


        WWWForm form = new WWWForm();
        //form.AddField("studentIdPost", _studentId);
        //form.AddField("programIdPost", _programId);
        Debug.Log("Sesstion ID" + _sesstionId);
        form.AddField("SessionIdPost", _sesstionId);
        WWW www = new WWW(url, form);
        StartCoroutine(waitforTimeTable(www));
    }
    public string[] data;
    public GameObject[] TimeTableDay;
    IEnumerator waitforTimeTable(WWW www)
    {
        yield return www;
         data = www.text.Split(char.Parse("|"));
        // check for errors
        if (www.error == null)
        {
            Debug.Log("TimeTable : " + www.text);
            timeTableHeader.text = _sesstionId.ToUpper() + "-"+_programId.ToUpper();
            for (int i = 0; i < data.Length-1; i++)
            {
                string[] temp = data[i].Split(char.Parse(","));
                if(temp[0] == "Monday")
                {
                    TimeTableDay[0].transform.GetChild(int.Parse(temp[1])).transform.GetChild(0).GetComponent<Text>().text = temp[3];
                    TimeTableDay[0].transform.GetChild(int.Parse(temp[1])).transform.GetChild(1).GetComponent<Text>().text = temp[2];
                }else if(temp[0] == "Tuesday")
                {
                    TimeTableDay[1].transform.GetChild(int.Parse(temp[1])).transform.GetChild(0).GetComponent<Text>().text = temp[3];
                    TimeTableDay[1].transform.GetChild(int.Parse(temp[1])).transform.GetChild(1).GetComponent<Text>().text = temp[2];
                }
                else if (temp[0] == "Wednasday")
                {
                    TimeTableDay[2].transform.GetChild(int.Parse(temp[1])).transform.GetChild(0).GetComponent<Text>().text = temp[3];
                    TimeTableDay[2].transform.GetChild(int.Parse(temp[1])).transform.GetChild(1).GetComponent<Text>().text = temp[2];
                }
                else if (temp[0] == "Thrusday")
                {
                    TimeTableDay[3].transform.GetChild(int.Parse(temp[1])).transform.GetChild(0).GetComponent<Text>().text = temp[3];
                    TimeTableDay[3].transform.GetChild(int.Parse(temp[1])).transform.GetChild(1).GetComponent<Text>().text = temp[2];
                }
                else if (temp[0] == "Friday")
                {
                    TimeTableDay[4].transform.GetChild(int.Parse(temp[1])).transform.GetChild(0).GetComponent<Text>().text = temp[3];
                    TimeTableDay[4].transform.GetChild(int.Parse(temp[1])).transform.GetChild(1).GetComponent<Text>().text = temp[2];
                }
            }


        }
        else
        {
            Debug.Log("WWW Error: " + www.error);
        }
    }

    public void SwitchScreen(GameObject screen)
    {
        for (int i = 0; i < UIScreens.Length; i++)
        {
            if(UIScreens[i] == screen)
            {
                UIScreens[i].SetActive(true);
            }else
            {
                UIScreens[i].SetActive(false);
            }
        }
    }

    void timetableEmpty()
    {
        for (int i = 0; i < TimeTableDay.Length; i++)
        {
            for (int j = 1; j < 7; j++)
            {
                TimeTableDay[i].transform.GetChild(j).transform.GetChild(0).GetComponent<Text>().text = "";
                TimeTableDay[i].transform.GetChild(j).transform.GetChild(1).GetComponent<Text>().text = "";
                TimeTableDay[i].transform.GetChild(j).transform.GetChild(2).GetComponent<Text>().text = "";
            }
        }
    }
}
