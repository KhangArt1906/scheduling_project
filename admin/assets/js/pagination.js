// System Requirements
/*Start*/
$(document).ready(function () {
  var jsonArrObj = [
    {
      software: "Power Designer",
      configuration:
        "Hệ điều hành: Microsoft Windows 7, 8, 8.1, 10 hoặc 11 hoặc Microsoft Windows Server 2008 hoặc 2012 (32-bit hoặc 64-bit) <br> CPU: bộ xử lý 2 GHz <br>  Bộ nhớ: RAM 3 GB <br> GPU: Bộ điều hợp đồ họa có độ phân giải SVGA hoặc cao hơn và màn hình màu tương thích (800x600) <br>  Dung lượng: Đĩa 1GB để cài đặt tất cả các mô-đun cốt lõi (và video trình diễn)",
    },
    {
      software: "Eclipse",
      configuration:
        "Hệ điều hành: Microsoft Windows 7, 8, 8.1, 10 hoặc 11 hoặc Microsoft Windows Server 2008 hoặc 2012 (32-bit hoặc 64-bit) <br> CPU: bộ xử lý 2 GHz <br>  Bộ nhớ: RAM 2 GB <br> GPU: Card onboard <br>  Dung lượng: 1GB",
    },
    {
      software: "Dev C/C++",
      configuration:
        "Windows XP, Vista, 7 and 8/8.1,10,<br> CPU: Pentium III/1.4GHz Processor. <br>  Bộ nhớ:512MB <br> thích (800x600) <br>  Dung lượng: 900MB space required",
    },
    {
      software: "Visual Studio Code",
      configuration:
        "Hệ điều hành: Microsoft Windows 7, 8, 8.1, 10 hoặc 11 hoặc Microsoft Windows Server 2008 hoặc 2012 (32-bit hoặc 64-bit) <br> CPU: bộ xử lý 2 GHz <br>  Bộ nhớ: RAM 3 GB <br> GPU: Bộ điều hợp đồ họa có độ phân giải SVGA hoặc cao hơn và màn hình màu tương thích (800x600) <br>  Dung lượng: Đĩa 1GB để cài đặt tất cả các mô-đun cốt lõi (và video trình diễn)",
    },
    {
      software: "Netbean",
      configuration:
        "Hệ điều hành: Windows 7 (32 bit hoặc 64 bit), Ubuntu 10 trở lên, Mac OS 10.7 trở lên <br> CPU: Pentium IV trở lên <br>  Bộ nhớ: RAM 3 GB <br>  Dung lượng: : Ít nhất 1GB .",
    },
    {
      software: "MySQL Workbench",
      configuration:
        "Microsoft  NET Framework 4.5.2, Microsoft Visual C++ Redistributable for Visual Studio 2019. <br> CPU: bộ xử lý 2 GHz <br>  Bộ nhớ: : 4 GB (6 GB Recommend). <br> GPU: Bộ điều hợp đồ họa có độ phân giải SVGA hoặc cao hơn và màn hình màu tương thích (800x600) <br>  Dung lượng: Dung lượng đĩa 1GB để cài đặt tất cả các mô-đun cốt lõi (và video trình diễn)",
    },
    {
      software: "Messenger",
      configuration:
        "Hệ điều hành:  Windows 7 Service Pack 1 or newer.<br> CPU: Intel core i5-4210 1.7ghz <br>  Bộ nhớ: 2 GB. <br> GPU: Intel HD Graphics 4400.) <br>  Dung lượng:1200 MB.",
    },
    {
      software: "Microsoft Project",
      configuration:
        "Hệ điều hành:Windows 10, Windows Server 2019   <br> CPU:1,6 gigahertz (GHz) hoặc nhanh hơn.<br>  Bộ nhớ: RAM 4 GB; RAM 2 GB (32 bit) <br> GPU: Màn hình hiển thị: Độ phân giải màn hình 1280 x 768.<br>  Dung lượng: : 4.0 GB dung lượng ổ đĩa còn trống.",
    },
    {
      software: "Facebook",
      configuration:
        "Hệ điều hành: Windows XP. <br> CPU: Single Core 2.4 GHZ. <br>  Bộ nhớ: 512 MB. <br> GPU: Nvidia GeForce 5xxx series or equivalent. <br>  Dung lượng: 5 Gigabytes.",
    },
    {
      software: "Spotify",
      configuration:
        "Hệ điều hành: Windows XP, Vista, or 7 <br> CPU: bộ xử lý 2 GHz <br>  Bộ nhớ: RAM 3 GB <br> GPU: Bộ điều hợp đồ họa có độ phân giải SVGA hoặc cao hơn và màn hình màu tương thích (800x600) <br>  Dung lượng: 50GB ",
    },
    {
      software: "Oracle VM VirtualBox",
      configuration:
        "Hệ điều hành: Microsoft Windows 7, 8, 8.1, 10 hoặc 11 hoặc Microsoft Windows Server 2008 hoặc 2012 (32-bit hoặc 64-bit) <br> CPU: 1.3 GHz*2 <br>  Bộ nhớ: 8GB <br> GPU: Bộ điều hợp đồ họa có độ phân giải SVGA hoặc cao hơn và màn hình màu tương thích (800x600) <br>  Dung lượng: 4 GB",
    },
  ];

  var jsonRoomSoftware = [
    {
      Room: "A-101 ",
      SoftwareApplication:
        "Power Designer, Dev C/C++, Atom, Visual Studio Code, Microsoft SQL Server, Zalo",
    },
    {
      Room: "A-102",
      SoftwareApplication:
        "Oracle Service, Eclipse, Netbean, Visual Studio Code",
    },
    {
      Room: "A-103",
      SoftwareApplication: "Microsoft SQL Server, Microsoft Word, Notepad++",
    },
    {
      Room: "A-104",
      SoftwareApplication: "Microsoft PowerPoint, Zalo, Messenger",
    },
    {
      Room: "A-105",
      SoftwareApplication: "Microsoft Excel, Netflix, Steam",
    },
  ];

  var page_number = 1;
  var records_per_page = 10;

  var total_page_system = Math.ceil(jsonArrObj.length / records_per_page);
  var total_page_roomsoftware = Math.ceil(
    jsonRoomSoftware.length / records_per_page
  );

  // Display pagination buttons
  $.fn.displayPaginationButtons = function () {
    var buttons_text =
      '<a href="#" onClick="javascript:$.fn.prevPage();">&laquo;</a>';
    var active = "";
    // Loop System Requirements
    for (var i = 1; i <= total_page_system; i++) {
      // Loop Room Software
      for (var i = 1; i <= total_page_roomsoftware; i++) {
        if (i == 1) {
          active = " active";
        } else {
          active = "";
        }
        buttons_text =
          buttons_text +
          '<a href="#" id="page_index' +
          i +
          '" onClick="javascript:$.fn.changePageIndex(' +
          i +
          ');" class="page_index' +
          active +
          '">' +
          i +
          "</a>";
      }
    }

    buttons_text =
      buttons_text +
      '<a href="#" onClick="javascript:$.fn.nextPage();">&raquo;</a>';
    $(".pagination-footer .pagination-buttons").text("");
    $(".pagination-footer .pagination-buttons").append(buttons_text);
  };

  $.fn.displayPaginationButtons();

  // Display table rows from json data
  $.fn.displayTableData = function () {
    // System Requirements
    var start_index = (page_number - 1) * records_per_page;

    var end_index = start_index + (records_per_page - 1);

    // DataTable System Requirements
    end_index =
      end_index >= jsonArrObj.length ? jsonArrObj.length - 1 : end_index;
    var inner_html_system = "";
    for (var i = start_index; i <= end_index; i++) {
      inner_html_system =
        inner_html_system +
        "<tr>" +
        '<td align="center">' +
        "<b>" +
        (i + 1) +
        "</b>" +
        "</td>" +
        '<td align="center">' +
        jsonArrObj[i].software +
        "</td>" +
        '<td align="left">' +
        jsonArrObj[i].configuration +
        "</td>" +
        "</tr>";
    }

    $("#software_hardware tbody tr").remove();
    $("#software_hardware tbody").append(inner_html_system);
    $("#page_index").removeClass("active");
    $("#page_index" + page_number).addClass("active");
    $(".pagination-details").text(
      "Showing " +
        (start_index + 1) +
        " to " +
        (end_index + 1) +
        " of " +
        jsonArrObj.length +
        " entries "
    );

    // DataTable Room Software Application
    end_index =
      end_index >= jsonRoomSoftware.length
        ? jsonRoomSoftware.length - 1
        : end_index;
    var inner_html_roomsoftware = "";
    for (var i = start_index; i <= end_index; i++) {
      inner_html_roomsoftware =
        inner_html_roomsoftware +
        "<tr>" +
        '<td align="center" class="room">' +
        jsonRoomSoftware[i].Room +
        "</td>" +
        "<td>" +
        jsonRoomSoftware[i].SoftwareApplication +
        "</td>" +
        "</tr>";
    }

    $("#room_software tbody tr").remove();
    $("#room_software tbody").append(inner_html_roomsoftware);
    $("#page_index").removeClass("active");
    $("#page_index" + page_number).addClass("active");
    $(".pagination-details").text(
      "Showing " +
        (start_index + 1) +
        " to " +
        (end_index + 1) +
        " of " +
        jsonRoomSoftware.length +
        " entries "
    );
  };

  $.fn.nextPage = function () {
    page_number++;
    $.fn.displayTableData();
  };
  $.fn.prevPage = function () {
    page_number--;
    $.fn.displayTableData();
  };

  $.fn.changePageIndex = function (index) {
    page_number = parseInt(index);
    $.fn.displayTableData();
  };

  $("#table-size").change(function () {
    var tab_size = $(this).val();
    page_number = 1;

    records_per_page = parseInt(tab_size);

    total_page = Math.ceil(jsonArrObj.length / records_per_page);
    $.fn.displayPaginationButtons();
    $.fn.displayTableData();
  });
  $.fn.displayTableData();
});
/*End*/
